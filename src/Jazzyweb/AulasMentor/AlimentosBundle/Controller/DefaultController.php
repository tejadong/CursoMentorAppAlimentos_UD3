<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Controller;

use Jazzyweb\AulasMentor\AlimentosBundle\Entity\Alimento;
use Jazzyweb\AulasMentor\AlimentosBundle\Form\Type\AlimentoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class DefaultController extends Controller
{

    public function indexAction()
    {
        $params = array(
            'mensaje' => 'Bienvenido al curso de Symfony2',
            'fecha' => date('d-m-yy'),
        );

        return $this->render(
                'JazzywebAulasMentorAlimentosBundle:Default:index.html.twig',
                $params
            );
    }

    public function listarAction()
    {
//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

        $em = $this->getDoctrine()->getManager();
        $alimentos = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->dameAlimentos();

        $params = array(
            'alimentos' => $alimentos,
        );

        return $this->render(
                'JazzywebAulasMentorAlimentosBundle:Default:mostrarAlimentos.html.twig',
                $params
            );
    }

    public function insertarAction(Request $request)
    {
//        $params = array(
//            'nombre' => '',
//            'energia' => '',
//            'proteina' => '',
//            'hc' => '',
//            'fibra' => '',
//            'grasa' => '',
//        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

        $alimento = new Alimento();

        $form = $this->createForm(new AlimentoType(), $alimento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->insertarAlimento($alimento);
            $this->get('session')->getFlashBag()->add('mensaje','El formulario era válido');
            return $this->redirect($this->generateUrl('JAMAB_insertar'));
        }

         return $this->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:formInsertar.html.twig',
                    array(
                        'alimento' => $alimento,
                        'form' => $form->createView())
                );

//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//            // comprobar campos formulario
//
//            if ($em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->insertarAlimento($_POST['nombre'], $_POST['energia'],
//                $_POST['proteina'], $_POST['hc'], $_POST['fibra'], $_POST['grasa'])) {
//                $params['mensaje'] = 'Alimento insertado correctamente';
//            } else {
//                $params = array(
//                    'nombre' => $_POST['nombre'],
//                    'energia' => $_POST['energia'],
//                    'proteina' => $_POST['proteina'],
//                    'hc' => $_POST['hc'],
//                    'fibra' => $_POST['fibra'],
//                    'grasa' => $_POST['grasa'],
//                );
//                $params['mensaje'] = 'No se ha podido insertar el alimento.
//                                   Revisa el formulario';
//            }
//        }
    }

    public function buscarPorNombreAction(Request $request)
    {
//        $params = array(
//            'nombre' => '',
//            'resultado' => array(),
//        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $em = $this->getDoctrine()->getManager();
//
//            $params['nombre'] = $_POST['nombre'];
//            $params['resultado'] = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->buscarAlimentosPorNombre($_POST['nombre']);
//        }
//        return $this ->render(
//                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorNombre.html.twig',
//                    $params
//                );

        $alimentoBuscadoPorNombre = new Alimento();
        $alimentos = null;

        $form = $this->createForm(new AlimentoType(), $alimentoBuscadoPorNombre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $alimentos = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->buscarAlimentosPorNombre($alimentoBuscadoPorNombre);
        }

        if (count($alimentos) <= 0) {
            $this->get('session')->getFlashBag()->add('mensaje','No se han encontrado alimentos con el término buscado.');
        }

        return $this->render(
            'JazzywebAulasMentorAlimentosBundle:Default:buscarPorNombre.html.twig',
            array(
                'alimentos' => $alimentos,
                'form' => $form->createView())
        );
    }

    public function buscarPorEnergiaAction(Request $request)
    {
//        $params = array(
//            'energia' => '',
//            'resultado' => array(),
//        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            $em = $this->getDoctrine()->getManager();
//
//            $params['energia'] = $_POST['energia'];
//            $params['resultado'] = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->buscarAlimentosPorEnergia($_POST['energia']);
//        }
//        return $this->render(
//                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorEnergia.html.twig',
//                    $params
//                );

        $alimentoBuscadoPorEnergia = new Alimento();
        $alimentos = null;

        $form = $this->createForm(new AlimentoType(), $alimentoBuscadoPorEnergia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $alimentos = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->buscarAlimentosPorEnergia($alimentoBuscadoPorEnergia);
        }

        if (count($alimentos) <= 0) {
            $this->get('session')->getFlashBag()->add('mensaje','No se han encontrado alimentos con la energía buscada.');
        }

        return $this->render(
            'JazzywebAulasMentorAlimentosBundle:Default:buscarPorEnergia.html.twig',
            array(
                'alimentos' => $alimentos,
                'form' => $form->createView())
        );
    }

    public function buscarPorCombinacionAction()
    {
        $params = array(
            'nombre' => '',
            'energia' => '',
            'resultado' => array(),
        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $em = $this->getDoctrine()->getManager();

            $params['nombre'] = $_POST['nombre'];
            $params['energia'] = $_POST['energia'];
            $params['resultado'] = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->buscarAlimentosPorCombinacion($_POST['nombre'], $_POST['energia']);
        }
        return $this->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorCombinacion.html.twig',
                    $params
                );
    }

    public function verAction($id)
    {
//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

//        $m = $this->get('jamab.model');

        $em = $this->getDoctrine()->getManager();

        $alimento = $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->dameAlimento($id);

        if(!$alimento)
        {
            throw new AccessDeniedHttpException();
        }

        $params['alimento'] = $alimento;
        $params['data'] = $this->get("jamab.wikiservice")->cargarPaginaWiki($alimento->getNombre());

        return $this->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:verAlimento.html.twig',
                    $params
                );

    }

    public function testInfoSenderAction()
    {
        $infosender = $this->get('jamab.infosender');

        $infosender->send('%Manzana%', 'tejadong@gmail.com');

        return new Response('<html><body><h2>Se ha enviado información a tejadong@gmail.com</h2></body></html>');
    }

    public function wikiAction()
    {
        return $this->render(
            'JazzywebAulasMentorAlimentosBundle:Default:pruebasWikiService.html.twig',
            array(
                'data' => $this->get("jamab.wikiservice")->cargarPaginaWiki('pera')
            )
        );

    }

}