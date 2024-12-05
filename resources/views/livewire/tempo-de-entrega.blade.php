<section id="localizacao">
    <div class="container">
        <h2>Calcular Tempo de Entrega</h2>


        <!-- Formulário de endereço -->
        <form wire:submit.prevent="calcularTempo">
            <div>
                <label for="endereco"></label>
                <input type="text" id="endereco" wire:model="endereco" placeholder="Digite seu CEP...">
            </div>

            <div>
                <button type="submit">Buscar</button>
            </div>
        </form>

        <!-- Mostrar o tempo de entrega -->
        @if ($tempoEntrega)
            <div>
                <strong>Tempo estimado de entrega:</strong> {{ $tempoEntrega }}
            </div>
        @endif
    </div>

</section>

