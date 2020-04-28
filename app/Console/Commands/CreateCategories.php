<?php

namespace App\Console\Commands;

use App\Model\Account;
use App\Model\Category;
use Illuminate\Console\Command;

class CreateCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $categories = [
            'Alimentação',
            'Mercado',
            'Transporte',
            'Automovel',
            'Trabalho',
            'Outros',
            'Bonus',
            'Salário',
            'Casa',
            'Serviços',
            'Emprestimo',
            'Cartão de Crédito',
            'Taxas',
            'Impostos',
            'Familia',
            'Lazer',
        ];
        for ($index=0; $index < count($categories); $index++) { 
            $category = new Category();
            $category->id = ($index + 1);
            $category->name = $categories[$index];
            $category->save();
        }
    }
}
