// records.mjs
import express from 'express';
import cors from 'cors';
import pg from 'pg';

const { Pool } = pg;
const app = express();
const port = 3000;

app.use(cors()); // 🟢 Включаем CORS!

const pool = new Pool({
    user: 'postgres',
    password: '123',
    host: 'localhost',
    port: 5432,
    database: 'game'
});

app.get('/sessions', async (req, res) => {
    try {
        const result = await pool.query('SELECT u.nickname as nick, st.kill_count as kc, st.score_count as sc, se.total_time as tt FROM public.user u JOIN public.session se ON u.hwid = se.hwid JOIN public.statistic st ON se.session_id = st.session_id');
        res.json(result.rows);
    } catch (error) {
        console.error("DB Error:", error);
        res.status(500).json({ error: "Ошибка базы данных" });
    }
});

app.listen(port, () => {
    console.log(`✅ Сервер запущен: http://localhost:${port}`);
});