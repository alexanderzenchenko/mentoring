<?php

interface ActionType
{
    const NAUGHTY = "naughty";
    const NICE = "nice";
}

class Action
{
    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $type;

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}

class ActionList implements Iterator
{
    /**
     * @var array
     */
    private $actionList;

    /**
     * @var int
     */
    private $position;

    /**
     * ActionList constructor.
     */
    public function __construct()
    {
        $this->actionList = [];
        $this->position = 0;
    }

    /**
     * @param Action $action
     */
    public function push(Action $action)
    {
        $this->actionList[] = $action;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->actionList[$this->position];
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key()
    {
        $this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->actionList[$this->position]);
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }
}

class ActionParser
{
    /**
     * @param string $text
     * @return Action
     */
    public function parse(string $text)
    {
        $action = new Action();
        $action->setTitle($text);
        $action->setType($this->getActionTypeByFirsChar($text[0]));

        return $action;
    }

    /**
     * @param string $char
     * @return string
     */
    private function getActionTypeByFirsChar(string $char)
    {
        if (in_array($char, ['b', 'f', 'k'])) {
            return ActionType::NAUGHTY;
        }
        if (in_array($char, ['g', 's', 'n'])) {
            return ActionType::NICE;
        }
    }
}

class ListAnalyzer
{
    /**
     * @param Iterator $actionList
     * @return string
     */
    public function getListType(Iterator $actionList): string
    {
        $naughty = 0;
        $nice = 0;

        foreach($actionList as $action) {
            if ($this->isNiceAction($action)) {
                $nice++;
            }
            if ($this->isNaughtyAction($action)) {
                $naughty++;
            }
        }

        return $nice > $naughty ? ActionType::NICE : ActionType::NAUGHTY;
    }

    /**
     * @param Action $action
     * @return bool
     */
    protected function isNiceAction(Action $action)
    {
        return $action->getType() === ActionType::NICE;
    }

    /**
     * @param Action $action
     * @return bool
     */
    protected function isNaughtyAction(Action $action)
    {
        return $action->getType() === ActionType::NAUGHTY;
    }
}

function what_list_am_i_on(array $actions): string {
    $actionParser = new ActionParser();
    $actionList = new ActionList();

    foreach($actions as $action) {
        $actionList->push($actionParser->parse($action));
    }

    $listAnalyzer = new ListAnalyzer();

    return $listAnalyzer->getListType($actionList);
}
