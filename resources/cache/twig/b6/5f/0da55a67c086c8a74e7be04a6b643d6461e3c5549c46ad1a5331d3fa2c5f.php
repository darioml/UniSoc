<?php

/* page-with-cache.html.twig */
class __TwigTemplate_b65f0da55a67c086c8a74e7be04a6b643d6461e3c5549c46ad1a5331d3fa2c5f extends Twig_Template
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
        $context["active"] = "page_with_cache";
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "
    ";
        // line 6
        if ($this->getAttribute($this->getContext($context, "app"), "debug")) {
            // line 7
            echo "        <div class=\"alert alert-error\" >
            <button class=\"close\" data-dismiss=\"alert\">×</button>
            <p>
                <h4>
                    Wrong front controller.
                </h4>
                Your are running the <pre>index_dev.php</pre> front
                controller, please run <pre>index.php</pre> front
                crontoller.
            </p>
        </div>
        <div class=\"alert-message block-message error\">
        </div>
    ";
        }
        // line 21
        echo "
    <p>
        This page is cached for 10 secondes<br />
        Hit @ : ";
        // line 24
        echo twig_escape_filter($this->env, $this->getContext($context, "date"), "html", null, true);
        echo ".<br />
        Try to refresh the page.<br />
    </p>

";
    }

    public function getTemplateName()
    {
        return "page-with-cache.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 24,  54 => 21,  38 => 7,  36 => 6,  33 => 5,  30 => 4,  25 => 2,);
    }
}
