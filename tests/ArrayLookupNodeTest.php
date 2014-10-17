<?php
namespace Pharborist;

class ArrayLookupNodeTest extends \PHPUnit_Framework_TestCase {
  public function testCreate() {
    $lookup = ArrayLookupNode::create(Token::variable('$form_state'), new StringNode(T_CONSTANT_ENCAPSED_STRING, "'storage'"));
    $this->assertEquals('$form_state[\'storage\']', $lookup->getText());
  }

  public function testGetRoot() {
    /** @var ArrayLookupNode $lookup */
    $lookup = Parser::parseExpression('$foo["bar"]["baz"][0]');
    $this->assertInstanceOf('\Pharborist\ArrayLookupNode', $lookup);
    $root = $lookup->getRoot();
    $this->assertInstanceOf('\Pharborist\VariableNode', $root);
    $this->assertEquals('$foo', $root->getText());

    $lookup = Parser::parseExpression('foo()["bar"]');
    $this->assertInstanceOf('\Pharborist\ArrayLookupNode', $lookup);
    $root = $lookup->getRoot();
    $this->assertInstanceOf('\Pharborist\Functions\FunctionCallNode', $root);
    $this->assertEquals('foo', $root->getName()->getText());
  }
}
