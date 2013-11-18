<?php
namespace NKN\BlogBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ControllerListener implements EventSubscriberInterface
{
    /**
     * @var Reader
     */
    private $annotationReader;

    public function __construct()//Reader $annotationReader)
    {
//        $this->annotationReader = $annotationReader;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        if (!is_array($controller = $event->getController())) {
            return;
        }
        list($controller, $methodName) = $controller;
        var_dump($event);die;
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
