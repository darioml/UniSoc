<?php

/* login.html.twig */
class __TwigTemplate_dc79a44894c542c709a931c1198f0541627e66a92df8c61bc3de62b8f9cad768 extends Twig_Template
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
        $context["active"] = "account";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "
    <h1>";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
        echo "</h1>

    ";
        // line 8
        if ($this->getContext($context, "error")) {
            // line 9
            echo "        <div class=\"alert alert-error\">
            ";
            // line 10
            echo twig_escape_filter($this->env, $this->getContext($context, "error"), "html", null, true);
            echo "
        </div>
        <div class=\"alert alert-info\">
            <strong>Hint:</strong> Try <code>username</code>/<code>password</code>
        </div>

    ";
        }
        // line 17
        echo "
    <form action=\"";
        // line 18
        echo $this->env->getExtension('routing')->getPath("login_check");
        echo "\" method=\"post\" novalidate ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'enctype');
        echo " class=\"form-vertical\">
        ";
        // line 19
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getContext($context, "form"), 'widget');
        echo "
        <div class=\"form-actions\">
            <button type=\"submit\" class=\"btn btn-primary\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Send"), "html", null, true);
        echo "</button>
        </div>
    </form>

";
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 21,  65 => 19,  59 => 18,  56 => 17,  46 => 10,  43 => 9,  41 => 8,  36 => 6,  33 => 5,  30 => 4,  25 => 2,);
    }
}
