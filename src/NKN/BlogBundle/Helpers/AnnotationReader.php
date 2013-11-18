<?php
/**
 * Created by PhpStorm.
 * User: nikon
 * Date: 18.11.13
 * Time: 18:28
 */

namespace NKN\BlogBundle\Helpers;

use Doctrine\Common\Annotations\Reader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Exception\InvalidParameterException;
use Symfony\Component\Security\Core\Util\ClassUtils;

/**
 * Class RestParamResolver
 * @package Quest\Portage\RESTBundle
 */
class AnnotationReader
{

    public $annotationReader;

    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param $controller
     * @param string $methodName
     * @return null|View
     */
    public function getView($controller, $methodName)
    {
        $annotations = $this->getAnnotations($controller, $methodName);
        $result = null;
        foreach ($annotations as $annotation) {
            if ($annotation instanceof View) {
                $result = $annotation;
                break;
            }
        }

        return $result;
    }

    /**
     * @param $controller
     * @param string $methodName
     * @return null|Template
     */
    public function getTemplate($controller, $methodName)
    {
        $annotations = $this->getAnnotations($controller, $methodName);
        $result = null;
        foreach ($annotations as $annotation) {
            if ($annotation instanceof Template) {
                $result = $annotation;
                break;
            }
        }

        return $result;
    }

    /**
     * @param $controller
     * @param $methodName
     * @return mixed
     */
    private function getAnnotations($controller, $methodName)
    {
        $reflection = new \ReflectionClass(ClassUtils::getRealClass($controller));
        $method = $reflection->getMethod($methodName);

        return $this->annotationReader->getMethodAnnotations($method);
    }
}