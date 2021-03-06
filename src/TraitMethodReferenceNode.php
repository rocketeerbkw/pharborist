<?php
namespace Pharborist;

/**
 * A reference to trait method name as part of a trait use declaration.
 */
class TraitMethodReferenceNode extends ParentNode {
  /**
   * @var NameNode
   */
  protected $traitName;

  /**
   * @var Node
   */
  protected $methodReference;

  /**
   * @return NameNode
   */
  public function getTraitName() {
    return $this->traitName;
  }

  /**
   * @return Node
   */
  public function getMethodReference() {
    return $this->methodReference;
  }
}
