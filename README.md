
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

###  :)

```bash
git clone git@github.com:bakcay/yengec.git
cd yengec
cp .env.example .env
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
sail up -d
sail artisan key:generate
sail artisan migrate
sail artisan passport:keys
sail artisan passport:client --personal --no-interaction
```

## Kullanım

Sistemi ayağa kaldırdıktan sonra öncelikle tek seferlik client oluşturulmasını sağlayınız. Eğer yaptıysanız bu adımı atlayın.
```bash
sail artisan passport:client --personal --no-interaction
```

Projeyi localhost dışında bir URL'de çalıştırıyorsanız, Postman collection'ınızın parametrelerindeki DOMAIN değerini projenizin çalıştığı URL ile güncelleyin.

Kullanıcı adı ve şifrenizi belirleyerek bir kullanıcı oluşturun. Bu işlem için aşağıdaki komutu kullanabilirsiniz:
POST /api/register
```
{
  "username": "email adresi",
  "password": "şifre"
}
```
Bu komut sonucunda aldığınız token değerini saklayın.

Token Alma (Login): Daha sonra, belirlediğiniz kullanıcı adı ve şifre ile token alabilirsiniz:
```
POST /api/login
{
  "username": "email adresi",
  "password": "şifre"
}
```
### Token Kullanımı

Aldığınız token bilgisini, Postman collection parametrelerindeki TOKEN alanına ekleyin.

### Entegrasyon Ekleme:

```
POST /api/integration
{
  "marketplace":"n11",
  "username": "kullanıcıadı",
  "password": "şifre"
}
```

Payload olarak marketplace, username, password parametrelerini JSON formatında gönderin.

### Entegrasyon Düzenleme:

```
PUT /integration/{id}
{
  "marketplace":"n11",
  "username": "kullanıcıadı",
  "password": "şifre"
}
```

Payload olarak marketplace, username, password parametrelerini JSON formatında gönderin. URL'de belirtilen {id} ile düzenlemek istediğiniz entegrasyonun ID'sini belirtin.

### Entegrasyon Silme:

DELETE /integration/{id}

URL'de belirtilen {id} ile silmek istediğiniz entegrasyonun ID'sini belirtin.



postman_collection.json dosyasını import ederek projeyi test edebilirsiniz.
[Postman Collection](postman_collection.json)


## Konsol Komutları

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



