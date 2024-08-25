<?php

namespace App\Modules\Student\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use ZipArchive;

readonly class DocService
{
    /**
     * Extract data from docs file.
     *
     * @param string $filePath
     * @return array
     */
    public function extractDataFromDocxFile(string $filePath): array
    {
        $content = '';
        $zip = new ZipArchive();
        if ($zip->open($filePath) === TRUE) {
            $index = $zip->locateName('word/document.xml');
            if ($index !== false) {
                $xmlContent = $zip->getFromIndex($index);
                if ($xmlContent !== false) {
                    $content .= $xmlContent;
                }
            }
            $zip->close();
        } else {
            return [];
        }

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);

        return $this->extractDataFromText(strip_tags($content));
    }

    /**
     * Extract data from text.
     *
     * @param string $text
     * @return array
     */
    public function extractDataFromText(string $text): array
    {
        $results = [];

        $pattern = '/(\d{4}-\d{2}-\d{2})\s*to\s*(\d{4}-\d{2}-\d{2})\s*(\d+) per session/';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $results[] = [
                'start_date' => $match[1],
                'end_date' => $match[2],
                'target' => $match[3],
            ];
        }

        $pattern = '/(\d{4}-\d{2}-\d{2})\s+(\d{4}-\d{2}-\d{2})\s+(\d+)/';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $results[] = [
                'start_date' => $match[1],
                'end_date' => $match[2],
                'target' => $match[3],
            ];
        }

        $pattern = '/(?:Start Date|Session start date)\s*(\d{4}-\d{2}-\d{2})\s*(?:End Date|Session end date)\s*(\d{4}-\d{2}-\d{2})\s*(?:target\s*(\d+)|Improvement target\s*(\d+))/s';
        preg_match_all($pattern, $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $results[] = [
                'start_date' => $match[1],
                'end_date' => $match[2],
                'target' => !empty($match[3]) ? $match[3] : ($match[4] ?? null),
            ];
        }

        return $results;
    }

    /**
     * Generate report.
     *
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function generateReport(array $data): string
    {
        $zip = new ZipArchive;
        $zipFileName = 'report.zip';
        if (file_exists($zipFileName)) {
            unlink(public_path($zipFileName));
        }

        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            foreach ($data as $key => $item) {
                $pdf = Pdf::loadView('templates.report_template', ['data' => $item]);
                $pdf->render();
                $zip->addFromString('report_' . $key . '.pdf', $pdf->output());
            }
            $zip->close();
        }

        return $zipFileName;
    }
}
