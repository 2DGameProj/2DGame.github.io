// Получаем тело таблицы
const tableBody = document.querySelector('#recordsTable tbody');

// Функция для форматирования даты
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString("ru-RU", { year: 'numeric', month: '2-digit', day: '2-digit' });
}

// Запрос на сервер для получения данных
fetch('http://localhost:3000/sessions')
    .then(response => {
        if (!response.ok) throw new Error("Ошибка сети: " + response.status);
        return response.json(); // Преобразуем ответ в JSON
    })
    .then(data => {
        // Добавляем строки с данными в таблицу
        data.forEach(record => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${record.nick}</td>
                <td>${record.kc}</td>
                <td>${record.sc}</td>
                <td>${formatDate(record.tt)}</td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error("Ошибка при получении данных:", error);
    });
