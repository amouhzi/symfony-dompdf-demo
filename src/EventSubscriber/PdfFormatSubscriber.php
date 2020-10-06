<?php

namespace App\EventSubscriber;

use App\Utils\HtmlToPdfConverter;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class PdfFormatSubscriber implements EventSubscriberInterface
{
    private HtmlToPdfConverter $htmlToPdfConverter;

    public function __construct(HtmlToPdfConverter $htmlToPdfConverter)
    {
        $this->htmlToPdfConverter = $htmlToPdfConverter;
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $request = $event->getRequest();

        if ('pdf' !== $request->getRequestFormat()) {
            return;
        }

        $request->setFormat('pdf', 'application/pdf');

        $response = $event->getResponse();

        $size = $request->get('size', 'A4');
        $orientation = $request->get('orientation');

        $response->setContent($this->htmlToPdfConverter->htmlToPdf($response->getContent(), $size, $orientation));
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
