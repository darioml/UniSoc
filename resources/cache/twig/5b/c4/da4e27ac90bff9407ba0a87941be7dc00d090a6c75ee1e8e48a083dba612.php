<?php

/* index.html.twig */
class __TwigTemplate_5bc4da4e27ac90bff9407ba0a87941be7dc00d090a6c75ee1e8e48a083dba612 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout.html.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        $context["active"] = "homepage";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "
    <h1>Hello</h1>
    ";
        // line 7
        if ($this->env->getExtension('security')->isGranted("ROLE_USER")) {
            // line 8
            echo "        Hello \"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "security"), "token"), "username"), "html", null, true);
            echo "\".<br />
        <a href=\"";
            // line 9
            echo $this->env->getExtension('routing')->getPath("logout");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Logout"), "html", null, true);
            echo "</a>
    ";
        } else {
            // line 11
            echo "        Your a not logged. Please <a href=\"";
            echo $this->env->getExtension('routing')->getPath("login");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("connect"), "html", null, true);
            echo "</a>
    ";
        }
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 11,  44 => 9,  39 => 8,  37 => 7,  33 => 5,  30 => 4,  25 => 2,);
    }
}
