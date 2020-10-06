<?php

declare(strict_types=1);

namespace App\Utils;

use Dompdf\Dompdf;

class HtmlToPdfConverter
{
    public function htmlToPdf(string $html, string $size, ?string $orientation): string
    {
        $dompdf = new Dompdf();

        $dompdf->getOptions()->setIsRemoteEnabled(true);
        $dompdf->getOptions()->setChroot(realpath(__DIR__.'/../../public'));
        $dompdf->loadHtml($html);
        $dompdf->setPaper($size, $orientation);
        $dompdf->render();

        return $dompdf->output();
    }
}
