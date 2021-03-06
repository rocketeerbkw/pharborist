<?php
namespace Pharborist;

use Pharborist\Functions\ArgumentTrait;

/**
 * A new expression, e.g. `new Foo()`
 *
 * You can access and modify the constructor arguments as with any other
 * function or method call.
 */
class NewNode extends ParentNode implements ExpressionNode {
  use ArgumentTrait;

  /**
   * @var NameNode
   */
  protected $className;

  /**
   * Returns the name of the instantiated class.
   *
   * @return NameNode
   */
  public function getClassName() {
    return $this->className;
  }
}
