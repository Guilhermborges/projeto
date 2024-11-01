<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários - Sistema RH</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .action-btns button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Gerenciamento de Funcionários</h2>
        <p class="text-center">Adicione e gerencie funcionários da empresa.</p>

        <!-- Botão de voltar -->
        <div class="text-start mb-3">
            <button class="btn btn-secondary" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Voltar
            </button>
        </div>

        <!-- Botão de adicionar funcionário -->
        <div class="text-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                <i class="fas fa-user-plus"></i> Adicionar Funcionário
            </button>
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Adicionar Funcionário
                        </button>
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Função para obter os funcionários do localStorage
        function getEmployees() {
            const employees = localStorage.getItem('employees');
            return employees ? JSON.parse(employees) : [];
        }

        // Função para salvar os funcionários no localStorage
        function saveEmployees() {
            localStorage.setItem('employees', JSON.stringify(employees));
        }

        // Array temporário de funcionários
        let employees = getEmployees();

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
                    <td class="action-btns">
                        <button class="btn btn-warning btn-sm" onclick="openEditModal(${index})">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="deleteEmployee(${index})">
                            <i class="fas fa-trash"></i> Excluir
                        </button>
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

            saveEmployees(); // Salva os dados no localStorage
            renderEmployeeTable();
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editEmployeeModal'));
            editModal.hide();
        });

        // Função para excluir o funcionário
        function deleteEmployee(index) {
            if (confirm(`Tem certeza que deseja excluir ${employees[index].name}?`)) {
                employees.splice(index, 1);
                saveEmployees(); // Atualiza o localStorage
                renderEmployeeTable();
            }
        }

        // Função para adicionar funcionário
        document.getElementById('addEmployeeForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const newEmployee = {
                id: employees.length ? employees[employees.length - 1].id + 1 : 1, // Incrementa o ID
                name: document.getElementById('employeeName').value,
                position: document.getElementById('employeePosition').value,
                department: document.getElementById('employeeDepartment').value,
            };
            employees.push(newEmployee);
            saveEmployees(); // Salva os dados no localStorage
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
