<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Funcionários - Sistema RH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 40px;
        }
        .modal-header, .modal-footer {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Funcionários da Empresa</h2>
        <p class="text-center">Lista de funcionários cadastrados. Utilize as opções para editar ou excluir registros.</p>

        <!-- Botão de adicionar funcionário -->
        <div class="text-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">Adicionar Funcionário</button>
        </div>

        <!-- Tabela de funcionários -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Departamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="employeeTableBody">
                <!-- Dados dos funcionários serão preenchidos dinamicamente aqui -->
            </tbody>
        </table>
    </div>

    <!-- Modal para adicionar funcionário -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Adicionar Funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="employeeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeePosition" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="employeePosition" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeDepartment" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="employeeDepartment" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar Funcionário</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar funcionário -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Editar Funcionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <input type="hidden" id="editEmployeeIndex">
                        <div class="mb-3">
                            <label for="editEmployeeName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="editEmployeeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeePosition" class="form-label">Cargo</label>
                            <input type="text" class="form-control" id="editEmployeePosition" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeeDepartment" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="editEmployeeDepartment" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Array temporário de funcionários (substituir por uma integração de banco de dados)
        const employees = [
            { id: 1, name: "Ana Silva", position: "Analista de RH", department: "Recursos Humanos" },
            { id: 2, name: "João Souza", position: "Desenvolvedor", department: "Tecnologia" },
            { id: 3, name: "Maria Oliveira", position: "Designer Gráfico", department: "Marketing" },
        ];

        // Renderiza a tabela de funcionários na tela
        function renderEmployeeTable() {
            const tableBody = document.getElementById('employeeTableBody');
            tableBody.innerHTML = ''; // Limpa o conteúdo da tabela

            employees.forEach((employee, index) => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${employee.id}</td>
                    <td>${employee.name}</td>
                    <td>${employee.position}</td>
                    <td>${employee.department}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="openEditModal(${index})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${index})">Excluir</button>
                    </td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Função para abrir o modal de edição
        function openEditModal(index) {
            const employee = employees[index];
            document.getElementById('editEmployeeIndex').value = index;
            document.getElementById('editEmployeeName').value = employee.name;
            document.getElementById('editEmployeePosition').value = employee.position;
            document.getElementById('editEmployeeDepartment').value = employee.department;

            // Exibe o modal de edição
            const editModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
            editModal.show();
        }

        // Função para editar o funcionário
        document.getElementById('editEmployeeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const index = document.getElementById('editEmployeeIndex').value;
            employees[index].name = document.getElementById('editEmployeeName').value;
            employees[index].position = document.getElementById('editEmployeePosition').value;
            employees[index].department = document.getElementById('editEmployeeDepartment').value;

            renderEmployeeTable();
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editEmployeeModal'));
            editModal.hide();
        });

        // Função para excluir o funcionário
        function deleteEmployee(index) {
            if (confirm(`Tem certeza que deseja excluir ${employees[index].name}?`)) {
                employees.splice(index, 1);
                renderEmployeeTable();
            }
        }

        // Função para adicionar funcionário
        document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const newEmployee = {
                id: employees.length + 1,
                name: document.getElementById('employeeName').value,
                position: document.getElementById('employeePosition').value,
                department: document.getElementById('employeeDepartment').value,
            };
            employees.push(newEmployee);
            renderEmployeeTable();
            document.getElementById('addEmployeeForm').reset();
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addEmployeeModal'));
            addModal.hide();
        });

        // Renderiza a tabela de funcionários ao carregar a página
        renderEmployeeTable();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
