<?php

namespace Williams\BladeStyler\Tests\Feature;

use Tests\TestCase;

class BladeStylerTest extends TestCase
{

    public function test_class_directive()
    {

        $blade = <<<'bs'

        @bs_set([
        'red'=>'text-red-500',
        'bold' => 'font-bold'
        ])

        <div @bs_class('red bold')>

        bs;

        $expected = '<div class="text-red-500 font-bold">';

        $this->assertBladeOutput($blade, $expected);
    }



    public function test_clear_directive(): void
    {
        $blade = <<<'bs'

        @bs_set([
        'red'=>'text-red-500',
        'bold' => 'font-bold'
        ])
        @bs_clear('red')

        <div @bs_class('red bold')>

        bs;

        $expected = '<div class="red font-bold">';

        $this->assertBladeOutput($blade, $expected);
    }

    public function test_clear_all_directive(): void
    {
        $blade = <<<'bs'

        @bs_set([
        'red'=>'text-red-500',
        'bold' => 'font-bold'
        ])
        @bs_clear

        <div @bs_class('red bold')>

        bs;

        $expected = '<div class="red bold">';

        $this->assertBladeOutput($blade, $expected);
    }

    public function test_string_directive(): void
    {
        $blade = <<<'bs'

        @bs_set([
        'red'=>'text-red-500',
        'bold' => 'font-bold'
        ])

        <div class="@bs_string('red bold')">

        bs;

        $expected = '<div class="text-red-500 font-bold">';

        $this->assertBladeOutput($blade, $expected);
    }

    public function test_conditional_styles(): void
    {
        $blade = <<<'bs'

        @bs_set([
            'red' => 'text-red-500',
            'bold' => 'font-bold'
        ])

        <div @bs_class(['red' => true, 'bold' => false])></div>

        bs;

        $expected = '<div class="text-red-500">';

        $this->assertBladeOutput($blade, $expected);
    }

    public function test_merge_directive(): void
    {
        $blade = <<<'bs'
        @php

        //Simulate component $attributes
        $attributes = new \Illuminate\View\ComponentAttributeBag;
        $attributes->setAttributes(['class' => 'm-2']);
        @endphp

        @bs_set([
            'red' => 'text-red-500',
            'bold' => 'font-bold'
        ])

        <div @bs_merge("red bold")></div>

        bs;

        $expected = '<div class="text-red-500 font-bold m-2">';

        $this->assertBladeOutput($blade, $expected);
    }


    private function assertBladeOutput($input, $output)
    {
        $response = $this->post('/_bladestyler/test', ['blade' => $input]);

        $response->assertStatus(200);
        $response->assertSee($output, false);
    }
}
