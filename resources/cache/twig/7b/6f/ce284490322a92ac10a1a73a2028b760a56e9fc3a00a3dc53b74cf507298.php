<?php

/* form.html.twig */
class __TwigTemplate_7b6fce284490322a92ac10a1a73a2028b760a56e9fc3a00a3dc53b74cf507298 extends Twig_Template
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
        $context["active"] = "form";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <h1>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Form"), "html", null, true);
        echo "</h1>
    ";
        // line 6
        echo         $this->env->getExtension('form')->renderer->renderBlock($this->getContext($context, "form"), 'form', array("action" => $this->env->getExtension('routing')->getPath("form")));
        echo "
";
    }

    public function getTemplateName()
    {
        return "form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  33 => 5,  30 => 4,  25 => 2,);
    }
}
