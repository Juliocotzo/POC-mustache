<?php
    require 'vendor/autoload.php';
    $m = new Mustache_Engine(array('entity_flags' => ENT_QUOTES));
?>
<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
    class Chris {
        public $name  = "Chris";
        public $value = 10000;
    
        public function taxed_value() {
            return $this->value - ($this->value * 0.4);
        }
    
        public $in_ca = true;
    }

?>

<?php 
    $template = 'Hello {{name}}
    You have just won {{value}} dollars!
    {{#in_ca}}
    Well, {{taxed_value}} dollars, after taxes.
    {{/in_ca}}'
?>

<?php
    $chris = new Chris;
    echo $m->render($template, $chris);
?>
<br>
<?php
    // VARIABLES
    $datos = array(
        'name' => "Chris",
        'company' => '<b>GitHub</b>',
        'frutas' => array('fruta1' => 'naranja', 'fruta2' => 'Fresa')
    );
    $template2 = 'Hello {{company}}';
    $template3 = 'Hello {{{company}}}';
    $template4 = 'Hello {{frutas.fruta2}}';
    echo $m->render($template2, $datos);
    echo '<br>';
    echo $m->render($template3, $datos);
    echo '<br>';
    echo $m->render($template4, $datos);

?>
<br>
<?php
    // IF
    $datos2 = array(
        'boolean' => true
    );
    $template5 = '{{# boolean}} Hello {{/ boolean}}';
    echo $m->render($template5, $datos2);

?>

<br>
<?php
    // For
    $datos3 = array(
        'repo' => array(
          array('name' => "resque" ),
          array('name' => "hub" ),
          array('name' => "rip" ),
        ),
      );
    $template5 = '{{# repo }}
    <ul>
        <li>{{name}}</li>
    </ul>
    {{/ repo }}';
    echo $m->render($template5, $datos3);
    echo '<br>';
    $datos4 = array('colors' => array('red', 'blue', 'green'));
    $template6 = '{{# colors }}
    <ul>
        <li>{{ . }}</li>
    </ul>
   {{/ colors }}';
    echo $m->render($template6, $datos4);

?>

<br>
<?php
    // Lambda
    $datos5 = array(
        'name' => "Willy",
        'embiggened' => function($text, Mustache_LambdaHelper $helper) {
          return strtoupper($helper->render($text));
        }
      );
    $template7 = '{{# embiggened }}
        {{ name }} is awesome.
    {{/ embiggened }}';
    echo $m->render($template7, $datos5);

?>
</body>
</html>