<?php
namespace Pharborist;

/**
 * An array lookup.
 *
 * For example $array[0]
 */
class ArrayLookupNode extends ParentNode implements VariableExpressionNode {
  /**
   * @var Node
   */
  protected $array;

  /**
   * @var Node
   */
  protected $key;

  /**
   * Creates a new array lookup.
   *
   * @param \Pharborist\ExpressionNode $array
   *  The expression representing the array (usually a VariableNode).
   * @param \Pharborist\ExpressionNode $key
   *  The expression representing the key (usually a string).
   *
   * @return static
   */
  public static function create(ExpressionNode $array, ExpressionNode $key) {
    $node = new static();
    $node->addChild($array, 'array');
    $node->addChild(Token::openBracket());
    $node->addChild($key, 'key');
    $node->addChild(Token::closeBracket());
    return $node;
  }

  /**
   * @return Node
   */
  public function getArray() {
    return $this->array;
  }

  /**
   * @return Node
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * Returns the root of the lookup.
   *
   * For example, given an expression like $foo['bar']['baz'],
   * this method will return a VariableNode for $foo.
   *
   * @return Node
   */
  public function getRoot() {
    return $this->array instanceof ArrayLookupNode ? $this->array->getRoot() : $this->array;
  }
}
