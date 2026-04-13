<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração - P24h</title>
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://pin.it/5jKyHe6Xh');
            background-size: cover; background-position: center; background-attachment: fixed;
            min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95); padding: 40px; border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); width: 100%; max-width: 600px; text-align: center;
        }

        h1 { color: #1a202c; margin-bottom: 10px; font-size: 24px; }
        p { color: #718096; margin-bottom: 30px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; text-align: left; }
        .form-group { margin-bottom: 15px; }
        .full-width { grid-column: span 2; }
        label { display: block; margin-bottom: 5px; font-weight: 600; color: #4a5568; font-size: 14px; }
        
        input, select {
            width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 25px; 
            box-sizing: border-box; background: #f7fafc; outline: none; transition: 0.3s;
        }

        input:focus { border-color: #3182ce; box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2); }

        .btn-save {
            background: #1a365d; color: white; padding: 15px; border: none; border-radius: 25px;
            width: 100%; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 20px; transition: 0.3s;
        }
        .btn-save:hover { background: #2a4365; transform: translateY(-2px); }

        .btn-back { display: block; margin-top: 15px; color: #718096; text-decoration: none; font-size: 14px; }
        
        @media (max-width: 500px) { .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <div class="card">
        <h1>CADASTRO DE CARTÓRIOS</h1>
        <p>Preencha os dados abaixo para cadastrar um cartório.</p>

        <form action="{{ route('cartorios.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Nome do Cartório*</label>
                    <input type="text" name="nome" placeholder="Mínimo 10 caracteres" value="{{ old('nome') }}" required>
                </div>

                <div class="form-group">
                    <label>CNPJ*</label>
                    <input type="text" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00" value="{{ old('cnpj') }}" required>
                    @error('cnpj')
                        <span style="color: #e53e3e; font-size: 12px; font-weight: bold;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tabelião*</label>
                    <input type="text" name="nome_tabeliao" placeholder="Nome do Responsável" value="{{ old('nome_tabeliao') }}" required>
                </div>

                <div class="form-group">
                    <label>Estado (UF)*</label>
                    <select name="estado_id" id="estado_id" required>
                        <option value="">Selecione</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nome }} ({{ $estado->uf }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Município*</label>
                    <select name="municipio_id" id="municipio_id" required>
                        <option value="">Selecione o estado primeiro</option>
                        @foreach($municipios as $m)
                            <option value="{{ $m->id }}" data-estado="{{ $m->estado_id }}">{{ $m->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status*</label>
                    <select name="ativo" required>
                        <option value="1">Ativo</option>
                        <option value="0">Inativo</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-save">Salvar Cartório</button>
            <a href="{{ route('cartorios.index') }}" class="btn-back">Voltar para a listagem</a>
        </form>
    </div>

    <script>
        // Máscara do CNPJ
        document.getElementById('cnpj').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); 
            if (value.length > 14) value = value.slice(0, 14); 
            let x = value.match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
        });

        // Filtro de Municípios por Estado
        document.getElementById('estado_id').addEventListener('change', function() {
            var estadoId = this.value;
            var selectMun = document.getElementById('municipio_id');
            var options = selectMun.options;

            for (var i = 0; i < options.length; i++) {
                var opt = options[i];
                if (opt.value !== "") {
                    opt.style.display = (opt.getAttribute('data-estado') == estadoId) ? "block" : "none";
                }
            }
            selectMun.value = ""; 
        });
    </script>
</body>
</html>