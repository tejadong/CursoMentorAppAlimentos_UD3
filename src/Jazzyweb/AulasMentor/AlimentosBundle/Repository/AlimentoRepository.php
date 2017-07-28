<?php

namespace Jazzyweb\AulasMentor\AlimentosBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Jazzyweb\AulasMentor\AlimentosBundle\Entity\Alimento;

/**
 * AlimentoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlimentoRepository extends EntityRepository
{
    public function dameAlimentos() {
        $em = $this->getEntityManager();

        return $em->createQueryBuilder()
                ->select('a')
                ->from('JazzywebAulasMentorAlimentosBundle:Alimento', 'a')
                ->orderBy('a.energia')
                ->getQuery()
                ->getResult();
    }

    public function buscarAlimentosPorNombre(Alimento $alimento) {
        $em = $this->getEntityManager();
        return $em->createQueryBuilder()
                    ->select('a')
                    ->from('JazzywebAulasMentorAlimentosBundle:Alimento', 'a')
                    ->where('a.nombre LIKE :nombre')
                    ->setParameter('nombre', $alimento->getNombre().'%')
                    ->orderBy('a.energia')
                    ->getQuery()
                    ->getResult();
    }

    public function buscarAlimentosPorEnergia(Alimento $alimento) {
        $em = $this->getEntityManager();
        return $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->findByEnergia($alimento->getEnergia());
    }

    public function buscarAlimentosPorCombinacion(Alimento $alimento) {
        $em = $this->getEntityManager();

        $alimentos = $em->createQueryBuilder()
                        ->select('a')
                        ->from('JazzywebAulasMentorAlimentosBundle:Alimento', 'a');

        $alimentos->where('1=1');

        if ($alimento->getNombre() != '') {
            $alimentos->andWhere('a.nombre LIKE :nombre');
        }

        if ($alimento->getEnergia() != '') {
            $alimentos->andWhere('a.energia LIKE :energia');
        }

        if ($alimento->getNombre() != '') {
            $alimentos->setParameter('nombre', $alimento->getNombre() .'%');
        }

        if ($alimento->getEnergia() != '') {
            $alimentos->setParameter('energia', $alimento->getEnergia() .'%');
        }

        $alimentos->orderBy('a.energia');

        return  $alimentos ->getQuery()->getResult();
    }

    public function dameAlimento($id) {
        $em = $this->getEntityManager();
        return $em->getRepository('JazzywebAulasMentorAlimentosBundle:Alimento')->find($id);
    }

    public function insertarAlimento(/*$n, $e, $p, $hc, $f, $g*/ Alimento $alimento) {
//        $alimento = new Alimento();
//        $alimento->setNombre($n);
//        $alimento->setEnergia($e);
//        $alimento->setProteina($p);
//        $alimento->setHidratocarbono($hc);
//        $alimento->setFibra($f);
//        $alimento->setGrasatotal($g);

        $em = $this->getEntityManager();
        $em->persist($alimento);
        $em->flush();

        return true;
    }
}
