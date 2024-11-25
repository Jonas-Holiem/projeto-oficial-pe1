<?php

namespace App\Livewire;

use Livewire\Component;

class SobreNos extends Component
{
    public $companyName = 'Hot Delivery';
    public $description = 'A Hot Delivery é uma empresa inovadora e referência em soluções de logística e entrega rápida. Nosso principal objetivo é facilitar a vida de nossos clientes, conectando pessoas e negócios com agilidade, segurança e eficiência. Com uma infraestrutura moderna e um time de profissionais altamente capacitados, oferecemos serviços personalizados que atendem às mais diversas demandas, garantindo a satisfação de quem confia em nosso trabalho.

Desde o início de nossas operações, buscamos nos destacar pela qualidade de nossos serviços, aliando tecnologia de ponta a processos logísticos inteligentes. Na Hot Delivery, acreditamos que cada entrega é uma oportunidade de criar experiências positivas e fortalecer relacionamentos. Por isso, nos dedicamos a entender as necessidades específicas de nossos clientes, sejam eles empresas ou consumidores finais, para entregar mais do que produtos: entregamos confiança e tranquilidade.

Atendemos a uma ampla variedade de segmentos, incluindo delivery de alimentos, transporte de documentos e entrega de mercadorias. Nossos serviços são pautados por valores como responsabilidade, compromisso e transparência, garantindo que cada etapa do processo seja conduzida com excelência. Além disso, estamos sempre atentos às inovações do mercado, investindo continuamente em tecnologias que tornam nosso trabalho ainda mais ágil e eficiente.

Seja para atender a uma demanda corporativa ou para levar um produto ao consumidor final, a Hot Delivery está pronta para ser sua parceira de confiança. Trabalhamos diariamente para superar expectativas, unindo rapidez, qualidade e um atendimento de excelência.

Hot Delivery: conectando destinos, entregando soluções.';

    public $mission = 'Oferecer serviços com agilidade e excelência.';
    public $vision = 'Ser líder no mercado de logística expressa.';
    public $values = [
        'Agilidade',
        'Inovação',
        'Compromisso com o cliente',
        'Transparência',
    ];

    public function render()
{
    return view('livewire.sobre-nos')->layout('layouts.app');
}
}


