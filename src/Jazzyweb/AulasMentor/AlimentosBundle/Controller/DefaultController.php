<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        return
            $this->render(
                'JazzywebAulasMentorAlimentosBundle:Default:index.html.twig',
                $params
            );
    }

    public function listarAction()
    {
//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $m = $this->get('jamab.model');

        $params = array(
            'alimentos' => $m->dameAlimentos(),
        );

        return
            $this->render(
                'JazzywebAulasMentorAlimentosBundle:Default:mostrarAlimentos.html.twig',
                $params
            );
    }

    public function insertarAction()
    {
        $params = array(
            'nombre' => '',
            'energia' => '',
            'proteina' => '',
            'hc' => '',
            'fibra' => '',
            'grasa' => '',
        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $m = $this->get('jamab.model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // comprobar campos formulario
            if ($m->insertarAlimento($_POST['nombre'], $_POST['energia'],
                $_POST['proteina'], $_POST['hc'], $_POST['fibra'], $_POST['grasa'])) {
                $params['mensaje'] = 'Alimento insertado correctamente';
            } else {
                $params = array(
                    'nombre' => $_POST['nombre'],
                    'energia' => $_POST['energia'],
                    'proteina' => $_POST['proteina'],
                    'hc' => $_POST['hc'],
                    'fibra' => $_POST['fibra'],
                    'grasa' => $_POST['grasa'],
                );
                $params['mensaje'] = 'No se ha podido insertar el alimento.
                                   Revisa el formulario';
            }
        }
        return
            $this
                ->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:formInsertar.html.twig',
                    $params
                );
    }

    public function buscarPorNombreAction()
    {
        $params = array(
            'nombre' => '',
            'resultado' => array(),
        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $m = $this->get('jamab.model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params['nombre'] = $_POST['nombre'];
            $params['resultado'] = $m->buscarAlimentosPorNombre($_POST['nombre']);
        }
        return
            $this
                ->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorNombre.html.twig',
                    $params
                );
    }

    public function buscarPorEnergiaAction()
    {
        $params = array(
            'energia' => '',
            'resultado' => array(),
        );

//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $m = $this->get('jamab.model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params['energia'] = $_POST['energia'];
            $params['resultado'] = $m->buscarAlimentosPorEnergia($_POST['energia']);
        }
        return
            $this
                ->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorEnergia.html.twig',
                    $params
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

        $m = $this->get('jamab.model');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $params['nombre'] = $_POST['nombre'];
            $params['energia'] = $_POST['energia'];
            $params['resultado'] = $m->buscarAlimentosPorCombinacion($_POST['nombre'], $_POST['energia']);
        }
        return
            $this
                ->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:buscarPorCombinacion.html.twig',
                    $params
                );
    }

    public function verAction($id)
    {
//        $m = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
//            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $m = $this->get('jamab.model');

        $alimento = $m->dameAlimento($id);

        if(!$alimento)
        {
            throw new AccessDeniedHttpException();
        }

        $params = $alimento;

        return
            $this
                ->render(
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
        $wikiService = $this->get("jamab.wikiservice");
        $infoWiki = $wikiService->cargarPaginaWiki('manzana');;

        return
            $this
                ->render(
                    'JazzywebAulasMentorAlimentosBundle:Default:pruebasWikiService.html.twig',
                    array(
                        'data' => $infoWiki
                    )
                );

    }

}