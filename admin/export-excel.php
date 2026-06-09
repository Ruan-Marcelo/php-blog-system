<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['username'])) {
    header("Location: ../admin-login.php");
    exit;
}

include_once(__DIR__ . "/../db_conn.php");

$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';

if ($tipo === 'animais') {
    $stmt = $conn->prepare("SELECT id, name, species, age, description FROM animals ORDER BY id DESC");
    $stmt->execute();

    $headers = ['ID', 'Nome', 'Especie', 'Idade', 'Descricao'];
    $rows = array_map(function ($animal) {
        return [
            $animal['id'],
            $animal['name'],
            $animal['species'],
            $animal['age'],
            $animal['description']
        ];
    }, $stmt->fetchAll(PDO::FETCH_ASSOC));

    exportXlsx('animais.xlsx', 'Animais', 'Relatorio de Animais', $headers, $rows);
}

if ($tipo === 'usuarios') {
    $stmt = $conn->prepare("SELECT id, fname, username FROM users ORDER BY id DESC");
    $stmt->execute();

    $headers = ['ID', 'Nome completo', 'Nome de usuario'];
    $rows = array_map(function ($user) {
        return [
            $user['id'],
            $user['fname'],
            $user['username']
        ];
    }, $stmt->fetchAll(PDO::FETCH_ASSOC));

    exportXlsx('usuarios.xlsx', 'Usuarios', 'Relatorio de Usuarios', $headers, $rows);
}

http_response_code(404);
echo "Exportacao nao encontrada.";

function exportXlsx($filename, $sheetName, $title, array $headers, array $rows)
{
    $xlsx = createZipArchive([
        '[Content_Types].xml' => getContentTypesXml(),
        '_rels/.rels' => getRootRelsXml(),
        'docProps/app.xml' => getAppXml($sheetName),
        'docProps/core.xml' => getCoreXml(),
        'xl/workbook.xml' => getWorkbookXml($sheetName),
        'xl/_rels/workbook.xml.rels' => getWorkbookRelsXml(),
        'xl/styles.xml' => getStylesXml(),
        'xl/worksheets/sheet1.xml' => getWorksheetXml($title, $headers, $rows)
    ]);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . strlen($xlsx));
    header('Cache-Control: max-age=0');

    echo $xlsx;
    exit;
}

function createZipArchive(array $files)
{
    $localFiles = '';
    $centralDirectory = '';
    $offset = 0;

    foreach ($files as $path => $content) {
        $compressed = gzdeflate($content, 9);
        $crc = crc32($content);
        $contentLength = strlen($content);
        $compressedLength = strlen($compressed);
        $pathLength = strlen($path);

        $localHeader = pack('VvvvvvVVVvv',
            0x04034b50,
            20,
            0,
            8,
            0,
            0,
            $crc,
            $compressedLength,
            $contentLength,
            $pathLength,
            0
        ) . $path;

        $centralDirectory .= pack('VvvvvvvVVVvvvvvVV',
            0x02014b50,
            20,
            20,
            0,
            8,
            0,
            0,
            $crc,
            $compressedLength,
            $contentLength,
            $pathLength,
            0,
            0,
            0,
            0,
            32,
            $offset
        ) . $path;

        $localFiles .= $localHeader . $compressed;
        $offset += strlen($localHeader) + $compressedLength;
    }

    $centralDirectoryLength = strlen($centralDirectory);
    $centralDirectoryOffset = strlen($localFiles);

    $endRecord = pack('VvvvvVVv',
        0x06054b50,
        0,
        0,
        count($files),
        count($files),
        $centralDirectoryLength,
        $centralDirectoryOffset,
        0
    );

    return $localFiles . $centralDirectory . $endRecord;
}

function getWorksheetXml($title, array $headers, array $rows)
{
    $columnCount = count($headers);
    $lastColumn = columnName($columnCount);
    $lastRow = count($rows) + 3;

    $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $xml .= '<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">';
    $xml .= '<sheetViews><sheetView workbookViewId="0"><pane ySplit="3" topLeftCell="A4" activePane="bottomLeft" state="frozen"/></sheetView></sheetViews>';
    $xml .= '<cols>';
    for ($i = 1; $i <= $columnCount; $i++) {
        $width = $i === 1 ? 12 : 24;
        if ($i === $columnCount && $columnCount > 3) {
            $width = 42;
        }
        $xml .= '<col min="' . $i . '" max="' . $i . '" width="' . $width . '" customWidth="1"/>';
    }
    $xml .= '</cols>';
    $xml .= '<sheetData>';
    $xml .= '<row r="1" ht="26" customHeight="1">';
    $xml .= textCell('A', 1, $title, 1);
    $xml .= '</row>';
    $xml .= '<row r="2"/>';
    $xml .= '<row r="3">';

    foreach ($headers as $index => $header) {
        $xml .= textCell(columnName($index + 1), 3, $header, 2);
    }

    $xml .= '</row>';

    foreach ($rows as $rowIndex => $row) {
        $excelRow = $rowIndex + 4;
        $xml .= '<row r="' . $excelRow . '">';

        foreach ($row as $cellIndex => $value) {
            $column = columnName($cellIndex + 1);
            if (is_numeric($value) && $cellIndex === 0) {
                $xml .= numberCell($column, $excelRow, $value, 3);
            } else {
                $xml .= textCell($column, $excelRow, formatCellValue($value, $headers[$cellIndex]), 3);
            }
        }

        $xml .= '</row>';
    }

    $xml .= '</sheetData>';
    $xml .= '<autoFilter ref="A3:' . $lastColumn . $lastRow . '"/>';
    $xml .= '<pageMargins left="0.7" right="0.7" top="0.75" bottom="0.75" header="0.3" footer="0.3"/>';
    $xml .= '</worksheet>';

    return $xml;
}

function textCell($column, $row, $value, $style)
{
    return '<c r="' . $column . $row . '" t="inlineStr" s="' . $style . '"><is><t>' . xmlEscape((string) $value) . '</t></is></c>';
}

function numberCell($column, $row, $value, $style)
{
    return '<c r="' . $column . $row . '" s="' . $style . '"><v>' . xmlEscape((string) $value) . '</v></c>';
}

function formatCellValue($value, $header)
{
    if ($header === 'Idade' && $value !== '' && $value !== null) {
        return $value . ' anos';
    }

    return $value;
}

function columnName($number)
{
    $name = '';
    while ($number > 0) {
        $remainder = ($number - 1) % 26;
        $name = chr(65 + $remainder) . $name;
        $number = (int) (($number - $remainder) / 26);
    }

    return $name;
}

function xmlEscape($value)
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_XML1, 'UTF-8');
}

function getContentTypesXml()
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
    <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
    <Default Extension="xml" ContentType="application/xml"/>
    <Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/>
    <Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/>
    <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
    <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
    <Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml"/>
</Types>';
}

function getRootRelsXml()
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
    <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/>
    <Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/>
</Relationships>';
}

function getWorkbookXml($sheetName)
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
    <sheets>
        <sheet name="' . xmlEscape($sheetName) . '" sheetId="1" r:id="rId1"/>
    </sheets>
</workbook>';
}

function getWorkbookRelsXml()
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
    <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
    <Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/>
</Relationships>';
}

function getStylesXml()
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
    <fonts count="3">
        <font><sz val="11"/><color rgb="FF1F2933"/><name val="Calibri"/></font>
        <font><b/><sz val="16"/><color rgb="FF0F5132"/><name val="Calibri"/></font>
        <font><b/><sz val="11"/><color rgb="FFFFFFFF"/><name val="Calibri"/></font>
    </fonts>
    <fills count="3">
        <fill><patternFill patternType="none"/></fill>
        <fill><patternFill patternType="gray125"/></fill>
        <fill><patternFill patternType="solid"><fgColor rgb="FF198754"/><bgColor indexed="64"/></patternFill></fill>
    </fills>
    <borders count="2">
        <border><left/><right/><top/><bottom/><diagonal/></border>
        <border>
            <left style="thin"><color rgb="FFDDE2E6"/></left>
            <right style="thin"><color rgb="FFDDE2E6"/></right>
            <top style="thin"><color rgb="FFDDE2E6"/></top>
            <bottom style="thin"><color rgb="FFDDE2E6"/></bottom>
            <diagonal/>
        </border>
    </borders>
    <cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0"/></cellStyleXfs>
    <cellXfs count="4">
        <xf numFmtId="0" fontId="0" fillId="0" borderId="0" xfId="0"/>
        <xf numFmtId="0" fontId="1" fillId="0" borderId="0" xfId="0"/>
        <xf numFmtId="0" fontId="2" fillId="2" borderId="1" xfId="0" applyFont="1" applyFill="1" applyBorder="1"/>
        <xf numFmtId="0" fontId="0" fillId="0" borderId="1" xfId="0" applyBorder="1" applyAlignment="1"><alignment vertical="top" wrapText="1"/></xf>
    </cellXfs>
    <cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0"/></cellStyles>
    <dxfs count="0"/>
    <tableStyles count="0" defaultTableStyle="TableStyleMedium2" defaultPivotStyle="PivotStyleLight16"/>
</styleSheet>';
}

function getAppXml($sheetName)
{
    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties" xmlns:vt="http://schemas.openxmlformats.org/officeDocument/2006/docPropsVTypes">
    <Application>PHP Blog System</Application>
    <TitlesOfParts><vt:vector size="1" baseType="lpstr"><vt:lpstr>' . xmlEscape($sheetName) . '</vt:lpstr></vt:vector></TitlesOfParts>
</Properties>';
}

function getCoreXml()
{
    $createdAt = gmdate('Y-m-d\TH:i:s\Z');

    return '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:dcmitype="http://purl.org/dc/dcmitype/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <dc:creator>PHP Blog System</dc:creator>
    <cp:lastModifiedBy>PHP Blog System</cp:lastModifiedBy>
    <dcterms:created xsi:type="dcterms:W3CDTF">' . $createdAt . '</dcterms:created>
    <dcterms:modified xsi:type="dcterms:W3CDTF">' . $createdAt . '</dcterms:modified>
</cp:coreProperties>';
}
