<?php
namespace NKN\BlogBundle\EventListener;

use NKN\BlogBundle\Helpers\AnnotationReader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Util\ClassUtils;

class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    public function __construct(AnnotationReader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        if (!is_array($controller = $event->getController())) {
            return;
        }
        list($controller, $methodName) = $controller;

        $template = $this->annotationReader->getTemplate($controller, $methodName);
        $template->setVars(['menu_array' => [[
        'name'=>'fffff',
        'href'=>'#',
        'active'=>0
    ],[
        'name'=>'fff',
        'href'=>'#',
        'active'=>1
    ],
        [
            'name'=>'eee',
            'href'=>'#',
            'active'=>false
        ],]]);
        $request->attributes->set('_template', $template);
        var_dump($request->attributes->all());die;
//        if ($template !== null) {
//            $request->attributes->set($template, $viewAnnotation->template);
//        }
//        var_dump($e);die;
//        $viewAnnotation = $this->annotationReader->getView($controller, $methodName);
//        if ($viewAnnotation !== null) {
//            $request->attributes->set(self::$template, $viewAnnotation->template);
//        }


//        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
//            $this->extension->setController($event->getController());
//        }
    }
    public function onKernelRequest(GetResponseEvent $event)
    {
//        var_dump($event);die;
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        var_dump($event);die;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {

    }

    /** @inheritdoc */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST       => ['onKernelRequest', 100],
            KernelEvents::CONTROLLER    => ['onKernelController'],
            KernelEvents::VIEW          => ['onKernelView'],
            KernelEvents::EXCEPTION     => ['onKernelException', 0]
        ];
    }
}
