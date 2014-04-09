<?php
namespace Pharborist;

/**
 * while control structure.
 */
class WhileNode extends StatementNode {
  protected $properties = array(
    'condition' => NULL,
    'body' => NULL,
  );

  /**
   * @return ExpressionNode
   */
  public function getCondition() {
    return $this->properties['condition'];
  }

  /**
   * @return Node
   */
  public function getBody() {
    return $this->properties['body'];
  }
}
