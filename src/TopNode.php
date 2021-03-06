<?php
namespace Pharborist;

/**
 * The root node of any Pharborist syntax tree.
 */
class TopNode extends StatementBlockNode {
  /**
   * Creates a new, blank PHP source file.
   *
   * @param string|NULL $ns
   *  If provided, the new document will have this namespace added to it.
   *
   * @return static
   */
  public static function create($ns = NULL) {
    $node = new TopNode();
    $node->addChild(Token::openTag());
    if (is_string($ns) && $ns) {
      $ns = NamespaceNode::create($ns)->appendTo($node);
      WhitespaceNode::create("\n")->insertBefore($ns);
      WhitespaceNode::create("\n")->insertAfter($ns);
    }
    return $node;
  }

  /**
   * Returns if this document contains a particular namespace.
   *
   * @param string $ns
   *  The name of the namespace to look for.
   *
   * @return boolean
   */
  public function hasNamespace($ns) {
    return in_array($ns, $this->getNamespaceNames());
  }

  /**
   * Returns every namespace in this document.
   *
   * @return \Pharborist\NodeCollection
   */
  public function getNamespaces() {
    return $this->children(Filter::isInstanceOf('\Pharborist\NamespaceNode'));
  }

  /**
   * Returns a particular namespace, if it exists.
   *
   * @param string $ns
   *  The name of the namespace to look for.
   *
   * @return \Pharborist\NamespaceNode|NULL
   */
  public function getNamespace($ns) {
    $namespaces = $this
      ->getNamespaces()
      ->filter(function(NamespaceNode $node) use ($ns) {
        return $node->getName()->getPath() === $ns;
      });

    return $namespaces->isEmpty() ? NULL : $namespaces[0];
  }

  /**
   * Returns the name of every namespace in this document.
   *
   * @return string[]
   */
  public function getNamespaceNames($absolute = FALSE) {
    $iterator = function(NamespaceNode $ns) use ($absolute) {
      $name = $ns->getName();
      return $absolute ? $name->getAbsolutePath() : $name->getPath();
    };
    return array_map($iterator, $this->getNamespaces()->toArray());
  }
}
