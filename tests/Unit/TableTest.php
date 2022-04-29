<?php

test('table defaults', function () {
    $table = makeTableClass();

    $this->assertSame('Custom Table Class', $table->title);
    $this->assertSame('This is a custom table class.', $table->description);
    expect(count($table->columns))->toBe(2);
    expect(count($table->rows))->toBe(10);
    expect(count($table->availableFilters))->toBe(1);
});