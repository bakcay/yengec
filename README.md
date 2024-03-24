
## Kurulum

Öncelikle projeyi klonlayın.

```bash
git clone git@github.com:bakcay/yengec.git
```

Daha sonra projenin bulunduğu dizine gidin.

```bash
cd yengec
```

Çalıştırmak için docker a ihtiyaç duyacaktır , docker kurulu değilse [docker](https://docs.docker.com/get-docker/) adresinden indirebilirsiniz.



.env dosyasını oluşturmak için aşağıdaki komutu çalıştırabilirsiniz.

```bash
cp .env.example .env
```

Gerekli dependency'leri yüklemek için aşağıdaki komutu çalıştırın.

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
```

Sail aliası eklemek için aşağıdaki komutu çalıştırın.
```bash
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```

key generate etmek için aşağıdaki komutu çalıştırabilirsiniz.



Daha sonra aşağıdaki komutu çalıştırarak projeyi ayağa kaldırabilirsiniz.

```bash
sail up -d
```

```bash
sail artisan key:generate
```



Veritabanı tablolarını oluşturmak için aşağıdaki komutu çalıştırabilirsiniz.

```bash
sail artisan migrate
```

Sail için generate etmek için aşağıdaki komutu çalıştırabilirsiniz.

```bash
sail artisan passport:keys
```

Passport client oluşturmak için aşağıdaki komutu çalıştırabilirsiniz.

```bash
sail artisan passport:client --personal --no-interaction
```

Artık kullanılabilir halde , 0.0.0.0:80 adresinden erişebilirsiniz. 
postman_collection.json dosyasını import ederek projeyi test edebilirsiniz.

## Kullanım

Sistemi ayağa kaldırdıktan sonra öncelikle tek seferlik client oluşturulmasını sağlayınız. Eğer yaptıysanız bu adımı atlayın.
```bash
sail artisan passport:client --personal --no-interaction
```
Ayağa kaldırdığınız url 0.0.0.0:80 harici ise collection parametrelerinden DOMAIN parametresinden değiştirebilirsiniz.

register komutu örneğindeki gibi kullanıcı adı ve şifrenizi belirleyerek kullanıcı oluşturun, bu komut sonucunda token keyindeki stringi saklayınız.

Daha sonra işlem yapmak için belirlediğiniz kullanıcı adı ve şifre ile de token alabilirsiniz.

- Login ve registerdaki aldığınız token bilgisini collectiondaki TOKEN parametresine yerleştiriniz.
- Entegrasyon oluşturmak için aldığınız token bilgisini elle güncellemek isterseniz "Bearer {token}" {token} parametreyle değiştiriniz
- entegrasyon ekleme için "integration create" methodunu kullanınız , marketplace , username , password parametreleri almaktadır.
- entegrasyon düzenleme için "integration update" methodunu kullanınız , marketplace , username , password parametreleri almaktadır.
- entegrasyon silme için "integration create" methodunu kullanınız , marketplace , username , password parametreleri almaktadır. querystring ile id girilmesi gereklidit
- entegrasyon silmek için "integration dekete" methodunu kullanınız ,querystring ile id girilmesi gerekmektedir.





postman_collection.json dosyasını import ederek projeyi test edebilirsiniz.
[Postman Collection](postman_collection.json)



Konsol üzerinden de test yapabilirsiniz,

Ekleme işlemi için örnek
```bash
sail artisan integration:add n11 username password
```


Güncelleme işlemi için örnek
```bash
sail artisan integration:update 1 trendyol username password
```

Silme işlemi için örnek
```bash
sail artisan integration:delete 1
```

Test İşlemlerini yapmak için aşağıdaki komutu kullanabilirsiniz

```bash
sail artisan test
```



