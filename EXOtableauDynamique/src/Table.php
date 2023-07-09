<?php

namespace App;

class Table {

    private $query;

    private $get;

    private $sortable = [];

    private $columns = [];

    private $limit = 20;

    private $formatters = [];

    const SORT_KEY = "sort";
    const DIR_KEY = "dir";


    public function __construct(QueryBuilder $query, array $get)
    {
        $this->query = $query;
        $this->get = $get;
    }

    public function sortable(string ...$sortable): self
    {
        $this->sortable = $sortable;
        return $this;
    }

    public function columns(array $columns): self
    {
        $this->columns = $columns;
        return $this;
    }   

    public function format(string $key, callable $function): self
    {
        $this->formatters[$key] = $function;
        return $this;
    }

    private function th(string $key): string
    {
        if(!in_array($key, $this->sortable)){
           return $this->columns[$key];
        }
        $sort = $this->get[self::SORT_KEY] ?? null;
        $direction = $this->get[self::DIR_KEY] ?? null;
        $icon = '';
        if($sort === $key){
            $icon = $direction === 'asc' ? '^' : 'v';
        }
        $url = URLHelper::withParams($this->get, [
            self::SORT_KEY => $key, 
            self::DIR_KEY => $sort === $key && $direction === 'asc' ? 'desc' : 'asc'
        ]);
        return <<<HTML
        <a href="?$url">{$this->columns[$key]} $icon</a>

        HTML;
    }

    private function td(string $key, array $item): string
    {
        if (isset($this->formatters[$key])) {
            return $this->formatters[$key]($item[$key]);
        }
        return $item[$key];
    }

    public function render(): string
    {
        $numPage = $this->get['p'] ?? 1;
        $count = (clone $this->query)->count();
        if(!empty($this->get['sort']) && in_array($this->get['sort'], $this->sortable)){
            $this->query->orderBy($this->get['sort'], $this->get['dir'] ?? 'asc');
        }
        $items = $this->query
            ->select(array_keys($this->columns))
            ->limit($this->limit)
            ->page($numPage)
            ->fetchAll();
        $numberPages = ceil($count / $this->limit);
        ob_start();
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <?php foreach ($this->columns as $key => $column): ?>
                        <th><?= $this->th($key) ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <?php foreach ($this->columns as $key => $column): ?>
                        <td><?= $this->td($key, $item) ?></td>
                    <?php endforeach ?>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?php if($numberPages > 1 && $numPage > 1): ?>
            <a href="?<?= URLHelper::withParam($this->get, 'p', $numPage - 1) ?>" class="btn btn-primary">Page précédente</a>
        <?php endif ?>

        <?php if($numberPages > 1 && $numPage < $numberPages): ?>
            <a href="?<?= URLHelper::withParam($this->get, 'p', $numPage + 1) ?>" class="btn btn-primary">Page suivante</a>
        <?php endif ?>

        <?php
        return ob_get_clean();
    }
}
