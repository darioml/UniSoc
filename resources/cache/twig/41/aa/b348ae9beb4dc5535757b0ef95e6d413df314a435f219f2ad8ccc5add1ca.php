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
        echo "/assets/css/semantic.min.css\">
    <link rel=\"stylesheet\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/css/main.css\">

</head>
<body>
    ";
        // line 22
        $context["active"] = ((array_key_exists("active", $context)) ? (_twig_default_filter($this->getContext($context, "active"), null)) : (null));
        // line 23
        echo "    <div class=\"ui teal inverted menu\">
        <a href=\"";
        // line 24
        echo $this->env->getExtension('routing')->getPath("homepage");
        echo "\" class=\"";
        if (("homepage" == $this->getContext($context, "active"))) {
            echo "active ";
        }
        echo "item\">
            <i class=\"home icon\"></i> ";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Homepage"), "html", null, true);
        echo "
        </a>
        <div class=\"";
        // line 27
        if (("account" == $this->getContext($context, "active"))) {
            echo " active";
        }
        echo "ui dropdown item\">
            <i class=\"icon user\"></i> Account <i class=\"dropdown icon\"></i>
            <div class=\"menu\">
                ";
        // line 30
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 31
            echo "                    <a href=\"";
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\" class=\"item\">Choice 1</a>
                ";
        } else {
            // line 33
            echo "                    <a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\" class=\"item\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
            echo "</a>
                    <a href=\"#\" class=\"item\">";
            // line 34
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Register"), "html", null, true);
            echo "</a>
                ";
        }
        // line 36
        echo "            </div>
        </div>
        <a class=\"item\">
            <i class=\"mail icon\"></i> Messages
        </a>
        <a class=\"item\">
            <i class=\"user icon\"></i> Friends
        </a>
    </div>

    <div class=\"container\">
        <div id=\"main\" role=\"main\" class=\"container\">
            ";
        // line 48
        $context["alertTypeAvaillable"] = array(0 => "info", 1 => "success", 2 => "warning", 3 => "error");
        // line 49
        echo "            ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "alertTypeAvaillable"));
        foreach ($context['_seq'] as $context["_key"] => $context["alert"]) {
            // line 50
            echo "                ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "getFlashBag"), "get", array(0 => $this->getContext($context, "alert")), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 51
                echo "                    <div class=\"alert alert-";
                echo twig_escape_filter($this->env, $this->getContext($context, "alert"), "html", null, true);
                echo "\" >
                        <button class=\"close\" data-dismiss=\"alert\">×</button>
                        ";
                // line 53
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getContext($context, "message")), "html", null, true);
                echo "
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['alert'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 57
        echo "            ";
        $this->displayBlock('content', $context, $blocks);
        // line 59
        echo "        </div>
    </div>

    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"";
        // line 63
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/libs/jquery-1.7.2.min.js\"><\\/script>')</script>
    <script src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/javascript/semantic.min.js\"></script>

    <script src=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "request"), "basepath"), "html", null, true);
        echo "/assets/javascript/script.js\"></script>
</body>
</html>
";
    }

    // line 57
    public function block_content($context, array $blocks = array())
    {
        // line 58
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
        return array (  174 => 58,  171 => 57,  163 => 66,  158 => 64,  154 => 63,  148 => 59,  145 => 57,  139 => 56,  130 => 53,  124 => 51,  119 => 50,  114 => 49,  112 => 48,  98 => 36,  93 => 34,  86 => 33,  80 => 31,  78 => 30,  70 => 27,  65 => 25,  57 => 24,  54 => 23,  52 => 22,  45 => 18,  41 => 17,  31 => 10,  20 => 1,);
    }
}
