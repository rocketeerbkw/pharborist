<?php
namespace Pharborist;

/**
 * foreach control structure.
 */
class ForeachNode extends StatementNode {
  /**
   * @var Node
   */
  protected $onEach;

  /**
   * @var Node
   */
  protected $key;

  /**
   * @var Node
   */
  protected $value;

  /**
   * @var Node
   */
  protected $body;

  /**
   * @return Node
   */
  public function getOnEach() {
    return $this->onEach;
  }

  /**
   * @return Node
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * @return Node
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * @return Node
   */
  public function getBody() {
    return $this->body;
  }
}
