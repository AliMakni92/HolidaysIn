<?php
/**
 * Created by PhpStorm.
 * User: wajih
 * Date: 30/11/2016
 * Time: 20:50
 */

namespace MyApp\GrapheBundle\Controller;

 use MyApp\GrapheBundle\Entity\Statistique;
 use Ob\HighchartsBundle\Highcharts\Highchart;
 use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class GrapheController extends Controller
{
    public function chartLineAction()
    {
$em = $this->container->get('doctrine')->getEntityManager();
$classes = $em->getRepository('MyAppGrapheBundle:Statistique')->findAll();
$tab = array();
$categories = array();
foreach ($classes as $classe) {
array_push($tab, $classe->getPrix());
array_push($categories, $classe->getNom());
}
 $series = array( array("name" => "Nb étudiants", "data" => $tab) );
 $ob = new Highchart(); $ob->chart->renderTo('linechart'); // #id du div où afficher le graphe
  $ob->title->text('Nombre des étudiants par niveau');
 $ob->xAxis->title(array('text' => "Classe"));
 $ob->yAxis->title(array('text' => "Nb étudiants"));
 $ob->xAxis->categories($categories);
  $ob->series($series);
 return $this->render('MyAppGrapheBundle:Graphe:LineChart.html.twig', array( 'chart' => $ob ));
}
}
