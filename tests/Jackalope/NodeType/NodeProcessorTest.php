<?php

namespace Jackalope\NodeType;

use Jackalope\NodeType\NodeProcessor;
use Jackalope\TestCase;

class NodeProcessorTest extends TestCase
{
    public function setUp()
    {
        $this->node = $this->getNodeMock();
        $this->nodeType1 = $this->getNodeTypeMock();
        $this->itemDefinition1 = $this->getItemDefinitionMock();
        $this->nodeDefinition1 = $this->getNodeDefinitionMock();
        $this->property1 = $this->getPropertyMock();

        $this->processor = new NodeProcessor();
    }

    public function testProcess()
    {
        $this->node->expects($this->once())
            ->method('getPrimaryNodeType')
            ->will($this->returnvalue($this->nodeType1));

        $this->node->expects($this->once())
            ->method('getMixinNodeTypes')
            ->will($this->returnValue(array(
            )));

        $this->nodeType1->expects($this->once())
            ->method('getDeclaredChildNodeDefinitions')
            ->will($this->returnValue(array(
                $this->itemDefinition1
            )));
        $this->nodeType1->expects($this->once())
            ->method('getDeclaredPropertyDefinitions')
            ->will($this->returnValue(array(
                $this->itemDefinition1
            )));

        $this->nodeType1->expects($this->once())
            ->method('getDeclaredSupertypes')
            ->will($this->returnValue(array()));

        $this->node->expects($this->once())
            ->method('getProperties')
            ->will($this->returnValue(array(
                $this->property1
            )));

        $this->processor->process($this->node);
    }
}
