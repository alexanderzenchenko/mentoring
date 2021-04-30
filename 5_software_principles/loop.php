<?php

interface NodesListInterface
{
    /**
     * @param Node $node
     * @return mixed
     */
    public function push(Node $node);

    /**
     * @param Node $node
     * @return mixed
     */
    public function inList(Node $node);

    /**
     * @param Node $node
     * @return mixed
     */
    public function getTail(Node $node);

    /**
     * @param Node $node
     * @return mixed
     */
    public function getLoop(Node $node);
}

class NodesList implements NodesListInterface
{
    const STRICT = true;

    /**
     * @var array
     */
    private $list;

    /**
     * NodesList constructor.
     */
    public function __construct()
    {
        $this->list = [];
    }

    /**
     * @param Node $node
     * @return void
     */
    public function push(Node $node)
    {
        $this->list[] = $node;
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function inList(Node $node)
    {
        return in_array($node, $this->list, static::STRICT);
    }

    /**
     * @param Node $node
     * @return int
     */
    public function getTail(Node $node)
    {
        return max(0, array_search($node, $this->list, static::STRICT));
    }

    /**
     * @param Node $node
     * @return int
     */
    public function getLoop(Node $node)
    {
        return count($this->list) - $this->getTail($node);
    }
}

class NodesWalker
{
    /**
     * @var NodesListInterface
     */
    private $nodesList;

    /**
     * NodesWalker constructor.
     * @param NodesListInterface $nodesList
     */
    public function __construct(NodesListInterface $nodesList)
    {
        $this->nodesList = $nodesList;
    }

    /**
     * @param Node $node
     * @return int
     */
    public function walk(Node $node)
    {
        $currentNode = $node;

        while ($currentNode && !$this->nodesList->inList($currentNode)) {
            $this->nodesList->push($currentNode);
            $currentNode = $currentNode->getNext();
        }

        return $this->nodesList->getLoop($currentNode);
    }
}

function loop_size(Node $node): int {
    $walker = new NodesWalker(new NodesList());
    return $walker->walk($node);
}
