<?php

class RwnewsRouter extends JComponentRouterView
{
    public function __construct($app = null, $menu = null)
    {
        $article = new JComponentRouterViewconfiguration('article');
        $article->setKey('id');
        $this->registerView($article);
        parent::__construct($app, $menu);

        $this->attachRule(new JComponentRouterRulesMenu($this));
        $this->attachRule(new JComponentRouterRulesStandard($this));
        $this->attachRule(new JComponentRouterRulesNomenu($this));
    }

    public function getArticleId($segment, $query)
    {
        return (int) $segment;
    }

    public function getArticleSegment($id, $query)
    {
        unset($query['view']);
        return array($id);
    }

    public function build(&$query)
    {
        $segments = array();
        switch ($query['view'])
        {
            case 'article': {
                $segments[] = $query['id'];
                break;
            }
            default: {
                $segments[] = $query['id'];
            }
        }
        unset($query['view'], $query['id']);
        return $segments;
    }

    public function parse(&$segments)
    {
        $menu = JFactory::getApplication()->getMenu('site')->getActive();
        $alias = $menu->alias;
        switch ($alias)
        {
            case 'article': {
                $menu->query['id'] = $segments[0];
                break;
            }
            default: {
                $menu->query['id'] = $segments[0];
            }
        }
        return parent::parse($segments);
    }
}
