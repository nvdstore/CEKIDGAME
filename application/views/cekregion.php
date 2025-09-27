<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Region Mobile Legends</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; background: #121212; color: white; }
        .container { max-width: 400px; margin: auto; padding: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: none; }
        button { width: 100%; padding: 10px; border: none; border-radius: 5px; background: #28a745; color: white; cursor: pointer; }
        #result { display: none; padding: 10px; border-radius: 5px; background: #333; }
    </style>
</head>
<body>

<div class="container">
    <h2>Cek Username & Region Mobile Legends</h2>
    <form id="stalkForm">
        <input type="text" id="user_id" placeholder="Masukkan ID" required>
        <input type="text" id="zone_id" placeholder="Masukkan Server" required>
        <button type="submit">Cek Username Dan Region</button>
    </form>

    <div id="result">
        <p><strong>ID:</strong> <span id="resultUserId"></span></p>
        <p><strong>Server:</strong> <span id="resultZoneId"></span></p>
        <p><strong>Nickname:</strong> <span id="resultNick"></span></p>
        <p><strong>Region:</strong> <span id="resultRegion"></span></p>
    </div>
</div>

<script>
document.getElementById('stalkForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const userId = document.getElementById('user_id').value.trim(),
          zoneId = document.getElementById('zone_id').value.trim(),
          result = document.getElementById('result'),
          rUserId = document.getElementById('resultUserId'),
          rZoneId = document.getElementById('resultZoneId'),
          rNick = document.getElementById('resultNick'),
          rRegion = document.getElementById('resultRegion');

    if (!userId || !zoneId) return alert('ID dan Server harus diisi!');

    let button = document.querySelector('button[type="submit"]');
    button.disabled = true;
    button.textContent = "Sedang mencari...";

    try {
        let res = await fetch("<?= base_url('cekregion/check') ?>", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ user_id: userId, zone_id: zoneId })
        });

        if (res.status === 429) {
            alert("Anda hanya dapat melakukan satu pencarian per hari.");
            button.disabled = false;
            button.textContent = "Cek Username Dan Region";
            return;
        }

        let data = await res.json();
        if (data.status) {
            let regionCode = data.data.region || "Tidak Diketahui";
            let regionFull = {
                MM: "Myanmar", ID: "Indonesia", MY: "Malaysia", SG: "Singapura",
                PH: "Filipina", TH: "Thailand", VN: "Vietnam", CN: "China",
                TW: "Taiwan", KR: "Korea Selatan", JP: "Jepang", EU: "Eropa",
                NA: "Amerika Utara", BR: "Brasil", LATAM: "Amerika Latin"
            }[regionCode] || regionCode;

            rUserId.textContent = userId;
            rZoneId.textContent = zoneId;
            rNick.textContent = data.data.nick || "Tidak Diketahui";
            rRegion.textContent = `${regionCode} (${regionFull})`;
            result.style.display = 'block';
        } else {
            alert('Data tidak ditemukan.');
        }
    } catch (err) {
        console.error('Error:', err);
        alert('Terjadi kesalahan saat mengambil data.');
    } finally {
        button.disabled = false;
        button.textContent = "Cek Username Dan Region";
    }
});
</script>

</body>
</html>
