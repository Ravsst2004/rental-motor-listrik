<?php require_once 'src/layouts/header.php'; ?>

<!-- FIRST CONTENT -->
<div class="flex w-full max-h-[60rem] overflow-hidden">
  <img src="./src/image/web-source/main-index.jpg" alt="">

  <div class="absolute top-[26%] left-[45%] transform inset-0 bg-black bg-opacity-30 py-2 pl-2 pr-64 h-fit rounded-lg">
    <h1 class="text-8xl font-semibold text-white relative z-10">E-Moto Rentals</h1>
    <p class="text-xl text-justify text-slate-50">At E-Moto Rentals, we're transforming urban transportation with our
      advanced electric motorcycles. Whether you're a tourist exploring the city sustainably or a local seeking
      eco-friendly commuting options, our bikes are the ideal choice.</p>
  </div>
  <div class="absolute top-[51%] left-[73%] transform inset-0 bg-black bg-opacity-30 py-4 pl-2 pr-64 h-fit rounded-lg">
    <?php if ($user): ?>
      <a href="service.php"
        class="text-xl text-slate-800 font-semibold bg-slate-50 w-fit py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-slate-50">Rent
        Now!</a>
    <?php elseif (!$user): ?>
      <a href="registration.php" class="text-xl text-slate-800 font-semibold bg-slate-50 w-fit py-2 px-4 rounded-lg hover:bg-slate-800
                                        hover:text-slate-50">Register now for rent!</a>
    <?php endif ?>
  </div>
</div>

<!-- SECOND CONTENT -->
<div class="w-full flex p-20 bg-slate-800 bg-opacity-20">
  <div class="w-[65%] flex flex-col gap-y-6">
    <div class="bg-[url('./src/image/web-source/bg-whychoose2.png')] bg-no-repeat bg-cover">
      <div class=" h-fit p-6 text-slate-100 bg-slate-800 bg-opacity-30 rounded-lg shadow flex flex-col">
        <h5 class="mb-2 text-2xl font-bold tracking-tight">Why Choose E-Moto Rentals?</h5>
        <ul class="flex-grow flex flex-col gap-y-6 font-normal text-justify text-slate-50">
          <li><strong>Eco-Friendly:</strong> Our electric motorcycles produce zero emissions, helping you reduce your
            carbon footprint while enjoying your ride.</li>
          <li><strong>Cost-Effective:</strong> Save on fuel and maintenance costs with our affordable rental rates and
            efficient electric technology.</li>
          <li><strong>Convenient:</strong> With multiple pick-up and drop-off locations throughout the city, renting a
            motorcycle has never been easier.</li>
          <li><strong>User-Friendly:</strong> Our motorcycles are designed for riders of all experience levels,
            providing a smooth and enjoyable ride.</li>
        </ul>
      </div>
    </div>
    <div class="flex gap-x-10 items-center justify-center py-28 px-5 h-fit">
      <div
        class="flex flex-col gap-y-1 items-center justify-center text-center cursor-pointer hover:scale-150 transition-all duration-300">
        <img src="./src/image/web-source/compare.svg" alt="" width="10%">
        <h1 class="text-2xl font-semibold">Compare</h1>
        <p class="text-md">Compare and find the best motorbike rental here! With a variety of choices, we
          provide
          flexibility to meet your travel needs.</p>
      </div>
      <div
        class="flex flex-col gap-y-1 items-center justify-center text-center cursor-pointer hover:scale-150 transition-all duration-300">
        <img src="./src/image/web-source/piggy-bank.svg" alt="" width="10%">
        <h1 class="text-2xl font-semibold">Save</h1>
        <p class="text-md">Rent a motorbike with us to save money and get a comfortable and economical driving
          experience at your destination</p>
      </div>
      <div
        class="flex flex-col gap-y-1 items-center justify-center text-center cursor-pointer hover:scale-150 transition-all duration-300">
        <img src="./src/image/web-source/time.svg" alt="" width="10%">
        <h1 class="text-2xl font-semibold">Time</h1>
        <p class="text-md">Our motorbike rental allows you to rent quickly and start exploring your destination without
          waiting long.</p>
      </div>
    </div>

  </div>
  <div class="w-[35%] flex justify-end">
    <img src="./src/image/web-source/second-index2.jpg" alt="" class="rounded-xl" width="72%">
  </div>
</div>

<!-- THIRD CONTENT -->
<div class="w-full py-10 bg-slate-800 bg-opacity-60 ">
  <div class="flex justify-center gap-x-10 items-center whitespace-nowrap">
    <img src="./src/image/web-source/third-content/g-force/2.jpg" alt="" class="rounded-xl inline-block" width="18%">
    <img src="./src/image/web-source/third-content/g-force/5.jpg" alt="" class="rounded-xl inline-block" width="18%">
    <img src="./src/image/web-source/third-content/g-force/4.jpg" alt="" class="rounded-xl inline-block" width="18%">
    <img src="./src/image/web-source/third-content/g-force/1.jpg" alt="" class="rounded-xl inline-block" width="18%">
    <img src="./src/image/web-source/third-content/g-force/3.jpg" alt="" class="rounded-xl inline-block" width="18%">
  </div>
</div>







<?php require_once 'src/layouts/footer.php'; ?>