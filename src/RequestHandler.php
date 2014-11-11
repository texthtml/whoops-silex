<?php

namespace WhoopsSilex;

use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Whoops\Handler\Handler;
use Whoops\Handler\PrettyPageHandler;

class RequestHandler extends Handler
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @inherit
     */
    public function handle()
    {
        $errorPageHandler = $this->container["whoops.error_page_handler"];
        if (!($errorPageHandler instanceof PrettyPageHandler)) {
            return;
        }

        $request = $this->request();

        if ($request === null) {
            // This error occurred too early in the application's life
            // and the request instance is not yet available.
            return;
        }

        $this->addRequestInfo($request, $errorPageHandler);
    }

    private function request()
    {
        $container = $this->container;

        if (!$container->offsetExists('request_stack')) {
            // This error occurred too early in the application's life
            // and the request stack instance is not yet available.
            return;
        }

        return $container['request_stack']->getCurrentRequest();
    }

    private function addRequestInfo(Request $request, PrettyPageHandler $handler)
    {
        $handler->addDataTable('Request', array(
            'URI'          => $request->getUri(),
            'Request URI'  => $request->getRequestUri(),
            'Path Info'    => $request->getPathInfo(),
            'Query String' => $request->getQueryString() ?: '<none>',
            'HTTP Method'  => $request->getMethod(),
            'Script Name'  => $request->getScriptName(),
            'Base Path'    => $request->getBasePath(),
            'Base URL'     => $request->getBaseUrl(),
            'Scheme'       => $request->getScheme(),
            'Port'         => $request->getPort(),
            'Host'         => $request->getHost(),
        ));
    }
}
