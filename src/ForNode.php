<?php
namespace Pharborist;

/**
 * A for control structure.
 */
class ForNode extends StatementNode {
  /**
   * @var CommaListNode
   */
  protected $initial;

  /**
   * @var CommaListNode
   */
  protected $condition;

  /**
   * @var CommaListNode
   */
  protected $step;

  /**
   * @var Node
   */
  protected $body;

  /**
   * @return CommaListNode
   */
  public function getInitial() {
    return $this->initial;
  }

  /**
   * @return CommaListNode
   */
  public function getCondition() {
    return $this->condition;
  }

  /**
   * @return CommaListNode
   */
  public function getStep() {
    return $this->step;
  }

  /**
   * @return Node
   */
  public function getBody() {
    return $this->body;
  }
}
