# Dokumentasi API Sasirangan

Dokumentasi API untuk aplikasi Sasirangan - Informasi Harga Bahan Pokok.

## Base URL

```
http://localhost:8000/api
```

## Endpoints Publik

### 1. Login

Autentikasi pengguna untuk mendapatkan token API.

**Endpoint:** `POST /api/login`

**Headers:**
```
Content-Type: application/json
```

**Body:**
```json
{
    "username": "nama_user",
    "password": "password_user"
}
```

**Response:**
```json
{
    "message": "Data Ditemukan",
    "data": {
        "id": 1,
        "name": "Nama User",
        "username": "nama_user",
        ...
    },
    "api_token": "1|abcdefghijklmnopqrstuvwxyz"
}
```

---

### 2. Daftar Pasar (Simple)

Mendapatkan daftar ID dan nama pasar saja.

**Endpoint:** `GET /api/info-harga/pasar`

**Headers:**
```
Accept: application/json
```

**Response:**
```json
{
    "message": "Data Pasar Ditemukan",
    "success": true,
    "data": [
        {
            "id": 1,
            "nama": "Pasar Teluk Dalam"
        },
        {
            "id": 2,
            "nama": "Pasar Lama"
        }
    ]
}
```

---

### 3. Daftar Pasar (Lengkap)

Mendapatkan semua data pasar dari model Pasar.

**Endpoint:** `GET /api/pasar`

**Headers:**
```
Accept: application/json
```

**Response:**
```json
{
    "success": true,
    "message": "Data Pasar Ditemukan",
    "total_data": 41,
    "data": [
        {
            "id": 35,
            "nama": "antasari",
            "lat": null,
            "long": null,
            "radius": null,
            "tampil_stok": "Y"
        },
        {
            "id": 18,
            "nama": "Bulog",
            "lat": null,
            "long": null,
            "radius": null,
            "tampil_stok": "Y"
        }
    ]
}
```

---

### 4. Informasi Harga Bahan Pokok

Mendapatkan informasi harga bahan pokok berdasarkan pasar dan tanggal.

**Endpoint:** `GET /api/info-harga`

**Headers:**
```
Accept: application/json
```

**Query Parameters:**

| Parameter | Tipe | Required | Deskripsi |
|-----------|------|----------|-----------|
| pasar_id | integer | Ya | ID pasar |
| tanggal | date | Tidak | Tanggal pencarian (format: Y-m-d). Default: hari ini |

**Contoh Request:**
```
GET /api/info-harga?pasar_id=1&tanggal=2026-07-23
```

**Response:**
```json
{
    "success": true,
    "message": "Data Harga Ditemukan",
    "pasar": {
        "id": 1,
        "nama": "Pasar Teluk Dalam"
    },
    "tanggal": "2026-07-23",
    "tanggal_kemarin": "2026-07-22",
    "total_data": 32,
    "data": [
        {
            "no": null,
            "bahan_pokok": "Unus Mutiara",
            "satuan": "Liter",
            "harga_kemarin": {
                "tanggal": "22-Jul-2026",
                "harga": 15000,
                "formatted": "Rp 15,000"
            },
            "harga_terkini": {
                "tanggal": "23-Jul-2026",
                "harga": 15000,
                "formatted": "Rp 15,000"
            },
            "perubahan": {
                "harga": 0,
                "formatted": "Rp 0"
            },
            "perubahan_persen": "0 %"
        }
    ]
}
```

**Error Response (validasi gagal):**
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "pasar_id": [
            "validation.required"
        ]
    }
}
```

---

## Endpoints Terproteksi (Requires Auth)

Endpoint berikut memerlukan autentikasi Sanctum dengan header:

```
Authorization: Bearer {api_token}
Accept: application/json
```

### 5. Data User

Mendapatkan informasi user yang sedang login.

**Endpoint:** `GET /api/user`

**Response:**
```json
{
    "message": "Data Ditemukan",
    "nama": "Nama User",
    "username": "nama_user",
    "pasar": {
        "id": 1,
        "nama": "Pasar Teluk Dalam"
    }
}
```

---

### 6. Ganti Password

Mengubah password user yang sedang login.

**Endpoint:** `POST /api/gantipassword`

**Body:**
```json
{
    "password": "password_baru"
}
```

**Response:**
```json
{
    "message": "Password Berhasil Diganti",
    "data": true
}
```

---

### 7. Data Komoditi

Mendapatkan data bahan pokok berdasarkan pasar dan tanggal.

**Endpoint:** `POST /api/komoditi`

**Body:**
```json
{
    "pasar_id": 1,
    "tanggal": "2026-07-23"
}
```

**Response:**
```json
{
    "message": "Data Ditemukan",
    "data": [
        {
            "id": 1,
            "bahan_id": 1,
            "pasar_id": 1,
            "tanggal": "2026-07-23",
            "harga": "15,000",
            "komoditi": "Unus Mutiara"
        }
    ]
}
```

---

### 8. Update Komoditi

Mengupdate harga bahan pokok.

**Endpoint:** `POST /api/komoditi/update`

**Body:**
```json
{
    "harga_id": 1,
    "harga": 16000,
    "pasar_id": 1,
    "tanggal": "2026-07-23"
}
```

**Response:**
```json
{
    "message": "Data Ditemukan",
    "data": [
        {
            "id": 1,
            "bahan_id": 1,
            "pasar_id": 1,
            "tanggal": "2026-07-23",
            "harga": "16,000",
            "komoditi": "Unus Mutiara"
        }
    ]
}
```

---

## Kode Status HTTP

| Kode | Deskripsi |
|------|-----------|
| 200 | OK - Request berhasil |
| 400 | Bad Request - Parameter tidak valid |
| 401 | Unauthorized - Token tidak valid |
| 404 | Not Found - Data tidak ditemukan |
| 422 | Unprocessable Entity - Validasi gagal |
| 500 | Internal Server Error - Server error |

---

## Contoh Penggunaan dengan cURL

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"username":"admin","password":"password"}'
```

### Daftar Pasar
```bash
curl http://localhost:8000/api/pasar \
  -H "Accept: application/json"
```

### Info Harga
```bash
curl "http://localhost:8000/api/info-harga?pasar_id=1&tanggal=2026-07-23" \
  -H "Accept: application/json"
```

### Endpoint Terproteksi
```bash
curl http://localhost:8000/api/user \
  -H "Authorization: Bearer {api_token}" \
  -H "Accept: application/json"
```

---

## Catatan

- Semua endpoint publik dapat diakses tanpa autentikasi
- Endpoint terproteksi memerlukan token API yang didapat dari proses login
- Format tanggal menggunakan format `Y-m-d` (contoh: `2026-07-23`)
- Response berupa JSON dengan header `Accept: application/json`
