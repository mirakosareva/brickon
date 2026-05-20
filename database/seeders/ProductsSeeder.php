<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $technic = Category::where('slug', 'technic')->first();
         $city = Category::where('slug', 'city')->first();
         $harryPotter = Category::where('slug', 'harry-potter')->first();
         $starWars = Category::where('slug', 'star-wars')->first();
        $creator = Category::where('slug', 'creator')->first();

        if (!$technic)
            {
                $technic = Category::create(['name' => 'Technic', 'slug' => 'technic', 'description' => 'Сложные механизмы']);
            }
        if (!$city) 
            {
                $city = Category::create(['name' => 'City', 'slug' => 'city', 'description' => 'Городская жизнь']);
            }
        if (!$harryPotter) 
            {
                $harryPotter = Category::create(['name' => 'Harry Potter', 'slug' => 'harry-potter', 'description' => 'Волшебный мир']);
            }
        if (!$starWars) 
            {
                $starWars = Category::create(['name' => 'Star Wars', 'slug' => 'star-wars', 'description' => 'Звездные войны']);
            }
        if (!$creator) 
            {
                $creator = Category::create(['name' => 'Creator', 'slug' => 'creator', 'description' => '3 в 1']);
            }

        $products = [
            // Technic
            [
                'category_id' => $technic->id,
                'name' => 'Lamborghini Sián FKP 37',
                'slug' => 'lamborghini-sian-fkp-37',
                'description' => 'Соберите культовый гибридный суперкар Lamborghini Sián FKP 37 из LEGO Technic. Модель 1:8 с детальным V12 двигателем, передним и задним подвесками, открывающимися дверями и уникальной отделкой.',
                'price' => 37999,
                'stock' => 5,
                'is_featured' => true,
                'image' => 'products/lamborghini-sian-fkp-37.jpg',
                'specs' => json_encode(['pieces' => 3696, 'age' => '18+', 'scale' => '1:8']),
            ],
            [
                'category_id' => $technic->id,
                'name' => 'Ford Mustang Shelby GT500',
                'slug' => 'ford-mustang-shelby-gt500',
                'description' => 'Культовый американский маслкар. Открывающиеся двери, подвижные поршни V8, уникальная отделка и реалистичный дизайн.',
                'price' => 14999,
                'stock' => 8,
                'is_featured' => true,
                'image' => 'products/ford-mustang-shelby-gt500.jpg',
                'specs' => json_encode(['pieces' => 1470, 'age' => '9+']),
            ],
            [
                'category_id' => $technic->id,
                'name' => 'Bugatti Chiron',
                'slug' => 'bugatti-chiron',
                'description' => 'Легендарный гиперкар Bugatti Chiron в масштабе 1:8. Работающий двигатель W16, активное заднее антикрыло, подвеска и полный привод.',
                'price' => 45999,
                'stock' => 3,
                'is_featured' => true,
                'image' => 'products/bugatti-chiron.jpg',
                'specs' => json_encode(['pieces' => 771, 'age' => '9+']),
            ],
            [
                'category_id' => $technic->id,
                'name' => 'Land Rover Defender',
                'slug' => 'land-rover-defender',
                'description' => 'Внедорожник Land Rover Defender с полным приводом, рабочим рулевым управлением и детализированным интерьером.',
                'price' => 23999,
                'stock' => 7,
                'image' => 'products/land-rover-defender.jpg',
                'specs' => json_encode(['pieces' => 2336, 'age' => '18+']),
            ],

            [
                'category_id' => $technic->id,
                'name' => 'Ferrari Daytona SP3',
                'slug' => 'ferrari-daytona-sp3',
                'description' => 'Элегантный Ferrari Daytona SP3. Дизайн вдохновлен классическими гоночными автомобилями.',
                'price' => 42999,
                'stock' => 4,
                'is_featured' => true,
                'image' => 'products/ferrari-daytona-sp3.jpg',
                'specs' => json_encode(['Детали' => 3778, 'Возраст' => '18+', 'Масштаб' => '1:8']),
            ],
            [
                'category_id' => $technic->id,
                'name' => 'Грузовой вертолет',
                'slug' => 'cargo-helicopter',
                'description' => 'Мощный грузовой вертолет с вращающимися лопастями и открывающейся грузовой рампой.',
                'price' => 11999,
                'stock' => 6,
                'image' => 'products/cargo-helicopter.jpg',
                'specs' => json_encode(['Детали' => 1042, 'Возраст' => '10+']),
            ],
            [
                'category_id' => $technic->id,
                'name' => 'Бульдозер',
                'slug' => 'bulldozer',
                'description' => 'Мощный бульдозер с подвижным ковшом и гусеницами.',
                'price' => 8999,
                'stock' => 10,
                'image' => 'products/bulldozer.jpg',
                'specs' => json_encode(['Детали' => 617, 'Возраст' => '9+']),
            ],
            
            // City
            [
                'category_id' => $city->id,
                'name' => 'Пожарная станция',
                'slug' => 'pozharnaya-stantsiya',
                'description' => 'Большая пожарная станция с выезжающей пожарной машиной, вертолетом и 4 минифигурками пожарных.',
                'price' => 8999,
                'stock' => 10,
                'is_featured' => true,
                'image' => 'products/pozharnaya-stantsiya.jpg',
                'specs' => json_encode(['pieces' => 153, 'age' => '4+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Полицейский участок',
                'slug' => 'politseyskiy-uchastok',
                'description' => 'Современный полицейский участок с тюремной камерой, полицейским автомобилем и вертолетом.',
                'price' => 10999,
                'stock' => 6,
                'image' => 'products/politseyskiy-uchastok.jpg',
                'specs' => json_encode(['pieces' => 912, 'age' => '6+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Строительная площадка',
                'slug' => 'stroitelnaya-ploshchadka',
                'description' => 'Большой экскаватор, самосвал и 3 строителя. Идеально для любителей техники.',
                'price' => 6999,
                'stock' => 12,
                'image' => 'products/stroitelnaya-ploshchadka.jpg',
                'specs' => json_encode(['pieces' => 657, 'age' => '6+']),
            ],

            [
                'category_id' => $city->id,
                'name' => 'Аэропорт',
                'slug' => 'airport',
                'description' => 'Большой аэропорт с пассажирским самолетом, автобусом и службами.',
                'price' => 13999,
                'stock' => 4,
                'image' => 'products/airport.jpg',
                'specs' => json_encode(['Детали' => 887, 'Возраст' => '8+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Поезд Metroliner',
                'slug' => 'metroliner-train',
                'description' => 'Скоростной поезд с рельсами, станцией и управлением через приложение.',
                'price' => 24999,
                'stock' => 3,
                'is_featured' => true,
                'image' => 'products/metroliner-train.jpg',
                'specs' => json_encode(['Детали' => 610, 'Возраст' => '6+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Дом на колесах',
                'slug' => 'camper-van',
                'description' => 'Дом на колесах с полностью оборудованным интерьером и велосипедами.',
                'price' => 5999,
                'stock' => 8,
                'image' => 'products/camper-van.jpg',
                'specs' => json_encode(['Детали' => 218, 'Возраст' => '5+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Скорая помощь',
                'slug' => 'ambulance',
                'description' => 'Машина скорой помощи с носилками и медицинским оборудованием.',
                'price' => 3499,
                'stock' => 15,
                'image' => 'products/ambulance.jpg',
                'specs' => json_encode(['Детали' => 184, 'Возраст' => '5+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Космический центр',
                'slug' => 'space-center',
                'description' => 'Космический центр с ракетой, диспетчерской и астронавтами.',
                'price' => 7999,
                'stock' => 7,
                'image' => 'products/space-center.jpg',
                'specs' => json_encode(['Детали' => 567, 'Возраст' => '6+']),
            ],
            [
                'category_id' => $city->id,
                'name' => 'Motorsport Команда',
                'slug' => 'motorsport-team',
                'description' => 'Гоночный автомобиль с трейлером и командой пит-стопа.',
                'price' => 16999,
                'stock' => 5,
                'image' => 'products/motorsport-team.jpg',
                'specs' => json_encode(['Детали' => 1086, 'Возраст' => '8+']),
            ],
            
            // Harry Potter
            [
                'category_id' => $harryPotter->id,
                'name' => 'Хогвартс. Замок',
                'slug' => 'hogwarts-castle',
                'description' => 'Грандиозный замок Хогвартс с Большим залом, башнями и 8 минифигурками главных героев.',
                'price' => 69999,
                'stock' => 2,
                'is_featured' => true,
                'image' => 'products/hogwarts-castle.jpg',
                'specs' => json_encode(['pieces' => 6020, 'age' => '18+']),
            ],
            [
                'category_id' => $harryPotter->id,
                'name' => 'Хогвартс Экспресс',
                'slug' => 'hogwarts-express',
                'description' => 'Легендарный поезд Хогвартс Экспресс с паровозом, вагонами и платформой 9¾.',
                'price' => 18999,
                'stock' => 4,
                'image' => 'products/hogwarts-express.jpg',
                'specs' => json_encode(['pieces' => 1229, 'age' => '8+']),
            ],
            [
                'category_id' => $harryPotter->id,
                'name' => 'Гремучая ива',
                'slug' => 'whomping-willow',
                'description' => 'Гремучая ива с вращающимися ветвями, летающий Ford Anglia и 4 минифигурки.',
                'price' => 14999,
                'stock' => 5,
                'image' => 'products/whomping-willow.jpg',
                'specs' => json_encode(['pieces' => 753, 'age' => '8+']),
            ],

            [
                'category_id' => $harryPotter->id,
                'name' => 'Большой зал',
                'slug' => 'great-hall',
                'description' => 'Большой зал Хогвартса с летающими свечами и длинными столами.',
                'price' => 22999,
                'stock' => 3,
                'image' => 'products/great-hall.jpg',
                'specs' => json_encode(['Детали' => 878, 'Возраст' => '9+']),
            ],
            [
                'category_id' => $harryPotter->id,
                'name' => 'Флитвич и Тризонье',
                'slug' => 'fleur-and-tonks',
                'description' => 'Спасательная миссия с участием Флер и Тонкс.',
                'price' => 3999,
                'stock' => 9,
                'image' => 'products/fleur-and-tonks.jpg',
                'specs' => json_encode(['Детали' => 349, 'Возраст' => '8+']),
            ],
            [
                'category_id' => $harryPotter->id,
                'name' => 'Бирючиновая аллея',
                'slug' => 'privet-alley',
                'description' => 'Домик семьи Дурслей открывается, как книжка, и дает возможность разыграть ключевые моменты визита тети Мардж — от ужина в столовой до «надувания» тетушки и побега Гарри через окно спальни.',
                'price' => 14999,
                'stock' => 4,
                'image' => 'products/privet-alley.jpg',
                'specs' => json_encode(['Детали' => 639, 'Возраст' => '9+']),
            ],
            
            // Star Wars
            [
                'category_id' => $starWars->id,
                'name' => 'Тысячелетний сокол',
                'slug' => 'millennium-falcon',
                'description' => 'Культовый корабль Хана Соло. Детализированный интерьер, съемная панель и 5 минифигурок.',
                'price' => 79999,
                'stock' => 1,
                'is_featured' => true,
                'image' => 'products/millennium-falcon.jpg',
                'specs' => json_encode(['pieces' => 7541, 'age' => '18+']),
            ],
            [
                'category_id' => $starWars->id,
                'name' => 'Звезда смерти',
                'slug' => 'death-star',
                'description' => 'Огромная Звезда смерти с залом совещаний, тронной комнатой и 23 минифигурками.',
                'price' => 49999,
                'stock' => 2,
                'image' => 'products/death-star.jpg',
                'specs' => json_encode(['pieces' => 4016, 'age' => '14+']),
            ],
            [
                'category_id' => $starWars->id,
                'name' => 'AT-AT',
                'slug' => 'at-at',
                'description' => 'Гигантский шагоход Империи с подвижными ногами и головой. Вмещает до 40 солдат.',
                'price' => 29999,
                'stock' => 3,
                'image' => 'products/at-at.jpg',
                'specs' => json_encode(['pieces' => 1267, 'age' => '9+']),
            ],

            [
                'category_id' => $starWars->id,
                'name' => 'Истребитель X-wing',
                'slug' => 'x-wing-fighter',
                'description' => 'Легендарный X-wing Люка Скайуокера с открывающимися крыльями.',
                'price' => 18999,
                'stock' => 6,
                'image' => 'products/x-wing-fighter.jpg',
                'specs' => json_encode(['Детали' => 527, 'Возраст' => '9+']),
            ],
            [
                'category_id' => $starWars->id,
                'name' => 'Шлем Дарта Вейдера',
                'slug' => 'darth-vader-helmet',
                'description' => 'Детализированная модель шлема Дарта Вейдера на подставке.',
                'price' => 7999,
                'stock' => 8,
                'is_featured' => true,
                'image' => 'products/darth-vader-helmet.jpg',
                'specs' => json_encode(['Детали' => 834, 'Возраст' => '18+']),
            ],
            [
                'category_id' => $starWars->id,
                'name' => 'Шлем Бобы Фетта',
                'slug' => 'boba-fett-helmet',
                'description' => 'Культовый шлем охотника за головами Бобы Фетта.',
                'price' => 7999,
                'stock' => 7,
                'image' => 'products/boba-fett-helmet.jpg',
                'specs' => json_encode(['Детали' => 625, 'Возраст' => '18+']),
            ],
            [
                'category_id' => $starWars->id,
                'name' => 'Droid Commander',
                'slug' => 'droid-commander',
                'description' => 'Набор с тремя дроидами R2-D2, D-O и управляемым приложением.',
                'price' => 12999,
                'stock' => 5,
                'image' => 'products/droid-commander.jpg',
                'specs' => json_encode(['Детали' => 1177, 'Возраст' => '8+']),
            ],
            
            // Creator
            [
                'category_id' => $creator->id,
                'name' => 'Уютный домик',
                'slug' => 'cozy-house',
                'description' => '3 в 1: можно собрать уютный домик, маяк или деревенский магазин. Отличный набор для творчества.',
                'price' => 5499,
                'stock' => 15,
                'is_featured' => true,
                'image' => 'products/cozy-house.jpg',
                'specs' => json_encode(['pieces' => 587, 'age' => '8+']),
            ],
            [
                'category_id' => $creator->id,
                'name' => 'Суперкар',
                'slug' => 'supercar',
                'description' => '3 в 1: суперкар, гоночный автомобиль или мощный пикап. Классический Creator набор.',
                'price' => 3999,
                'stock' => 20,
                'image' => 'products/supercar.jpg',
                'specs' => json_encode(['pieces' => 256, 'age' => '9+']),
            ],

            [
                'category_id' => $creator->id,
                'name' => 'Пиратский корабль',
                'slug' => 'pirate-ship',
                'description' => '3 в 1: пиратский корабль, таверна или остров с сокровищами.',
                'price' => 8999,
                'stock' => 8,
                'image' => 'products/pirate-ship.jpg',
                'specs' => json_encode(['Детали' => 1264, 'Возраст' => '9+']),
            ],
            [
                'category_id' => $creator->id,
                'name' => 'Динозавр',
                'slug' => 'dinosaur',
                'description' => '3 в 1: динозавр, дракон или бабочка. Отличный подарок для детей.',
                'price' => 2499,
                'stock' => 25,
                'image' => 'products/dinosaur.jpg',
                'specs' => json_encode(['Детали' => 174, 'Возраст' => '7+']),
            ],
            [
                'category_id' => $creator->id,
                'name' => 'Аэроплан',
                'slug' => 'airplane',
                'description' => '3 в 1: аэроплан, вертолет или гидросамолет.',
                'price' => 3499,
                'stock' => 18,
                'image' => 'products/airplane.jpg',
                'specs' => json_encode(['Детали' => 178, 'Возраст' => '7+']),
            ],
            [
                'category_id' => $creator->id,
                'name' => 'Парк развлечений',
                'slug' => 'amusement-park',
                'description' => '3 в 1: колесо обозрения, карусель или американские горки.',
                'price' => 11999,
                'stock' => 6,
                'is_featured' => true,
                'image' => 'products/amusement-park.jpg',
                'specs' => json_encode(['Детали' => 678, 'Возраст' => '9+']),
            ],
            [
                'category_id' => $creator->id,
                'name' => 'Космический шаттл',
                'slug' => 'space-shuttle',
                'description' => '3 в 1: космический шаттл, луноход или космическая станция.',
                'price' => 6499,
                'stock' => 10,
                'image' => 'products/space-shuttle.jpg',
                'specs' => json_encode(['Детали' => 144, 'Возраст' => '6+']),
            ],
        ];

        foreach ($products as $product)
            {
                Product::updateOrCreate(
                    ['slug'=> $product['slug']],
                    $product
                );
            }
            $this->command->info('Товары успешно добавлены!');
    }
}
