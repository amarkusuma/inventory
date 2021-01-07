

## petunjuk penggunaan

1. pastikan komputer anda terhubung dengan internet

2. buka vscode lalu setting file .env sesuai dengan nama database , username dan password di
   database lokal anda
   
3. jalankan perintah php artisan migrate

4. jalankan perintah php artisan db:seed --class=insert_user 
   lalu login dengan username: amar & password: amar123
   atau lihat di seeder file insert_user
   
5. jalankan perintah php artisan db:seed --class=insert_master_barang
   agar memiliki default data barang atau bisa input manual 
   
6. jalankan perintah php artisan db:seed --class=insert_master_supplier
   agar memiliki default data supplier atau bisa input manual 

7. jalankan perintah php artisan db:seed --class=insert_master_pelanggan
   agar memiliki default data pelanggan atau bisa input manual 
