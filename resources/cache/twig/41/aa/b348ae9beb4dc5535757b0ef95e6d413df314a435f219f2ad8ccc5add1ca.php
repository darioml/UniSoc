<?php

/* layout.html.twig */
class __TwigTemplate_41aab348ae9beb4dc5535757b0ef95e6d413df314a435f219f2ad8ccc5add1ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<!--[if lt IE 7]> <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\" lang=\"en\"> <![endif]-->
<!--[if IE 7]>    <html class=\"no-js lt-ie9 lt-ie8\" lang=\"en\"> <![endif]-->
<!--[if IE 8]>    <html class=\"no-js lt-ie9\" lang=\"en\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\" lang=\"en\"> <!--<![endif]-->
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">

    <title>";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Homepage"), "html", null, true);
        echo "</title>

    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <meta name=\"viewport\" content=\"width=device-width\">

    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/css/styles.css\">

    <script src=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/js/libs/modernizr-2.5.3-respond-1.1.0.min.js\"></script>
</head>
<body>
<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href=\"http://browsehappy.com/\">Upgrade to a different browser</a> or <a href=\"http://www.google.com/chromeframe/?redirect=true\">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    ";
        // line 24
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter($this->getContext($context, "active"), null)) : (null));
        // line 25
        echo "    <div class=\"navbar navbar-fixed-top\">
        <div class=\"navbar-inner\">
            <div class=\"container\">
                <a class=\"brand\" href=\"";
        // line 28
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Silex Kitchen Sink Edition"), "html", null, true);
        echo "</a>
                <div class=\"nav-collapse\">
                    <ul class=\"nav\">
                        <li ";
        // line 31
        if (("homepage" == $this->getContext($context, "active"))) {
            echo "class=\"active\"";
        }
        echo "><a href=\"";
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Homepage"), "html", null, true);
        echo "</a></li>
                        <li class=\"dropdown";
        // line 32
        if (("account" == $this->getContext($context, "active"))) {
            echo " active";
        }
        echo "\">
                            <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                Account <b class=\"caret\"></b>
                            </a>
                            <ul class=\"dropdown-menu\">
                                ";
        // line 37
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 38
            echo "                                    <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
            echo "</a></li>
                                ";
        } else {
            // line 40
            echo "                                    <li><a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
            echo "</a></li>
                                    <li><a href=\"#\">";
            // line 41
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Register"), "html", null, true);
            echo "</a></li>
                                ";
        }
        // line 43
        echo "                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>

    <div class=\"container\">
        <div id=\"main\" role=\"main\" class=\"container\">
            ";
        // line 53
        $context["alertTypeAvaillable"] = array(0 => "info", 1 => "success", 2 => "warning", 3 => "error");
        // line 54
        echo "            ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "alertTypeAvaillable"));
        foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
            // line 55
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlashBag"), "get", array(0 => $this->getContext($context, "alert")), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 56
                echo "                    <div class=\"alert alert-";
                echo twig_escape_filter($this->env, $this->getContext($context, "alert"), "html", null, true);
                echo "\" >
                        <button class=\"close\" data-dismiss=\"alert\">×</button>
                        ";
                // line 58
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getContext($context, "message")), "html", null, true);
                echo "
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "            ";
        $this->displayBlock('content', $context, $blocks);
        // line 64
        echo "        </div>
    </div>

    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/js/libs/jquery-1.7.2.min.js\"><\\/script>')</script>
    <script src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/js/scripts.js\"></script>
</body>
</html>
";
    }

    // line 62
    public function block_content($context, array $blocks = array())
    {
        // line 63
        echo "            ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 63,  177 => 62,  169 => 69,  165 => 68,  159 => 64,  156 => 62,  150 => 61,  141 => 58,  135 => 56,  130 => 55,  125 => 54,  123 => 53,  111 => 43,  106 => 41,  99 => 40,  91 => 38,  89 => 37,  79 => 32,  69 => 31,  61 => 28,  56 => 25,  54 => 24,  46 => 19,  41 => 17,  31 => 10,  20 => 1,);
    }
}
