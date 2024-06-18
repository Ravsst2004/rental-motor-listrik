<?php

?>

<?php require_once 'src/layouts/header.php'; ?>

<!-- <?php if (isset($user)): ?>
  <section class="bg-gray-50">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Welcome, <?= $user; ?>!
          </h1>
          <p class="text-gray-500">This is your dashboard.</p>

        </div>
      </div>
    </div>
  </section>
<?php endif; ?> -->


<div class="h-fit text-stone-100">

  <!-- FIRST CONTENT -->
  <div class="flex w-full px-10 lg:px-20 pt-36 pb-48 items-center bg-gradient-to-r from-blue-400 to-blue-500 gap-x-20 ">
    <div class="w-full xl:w-[60%] flex flex-col gap-y-2 pr-44">
      <h1 class="text-6xl font-semibold">E-Moto Rentals </h1>
      <h3 class="text-2xl font-semibold">Your Destination for Eco-Friendly Electric Motorcycle
        Rentals</h3>
      <p class="text-xl text-justify">At E-Moto Rentals, we are committed to revolutionizing urban transportation with
        our fleet
        of cutting-edge
        electric motorcycles. Whether you're a tourist looking to explore the city in a fun and sustainable way, or a
        local in need of a convenient and eco-friendly commuting option, our electric motorcycles are the perfect
        solution.</p>
      <?php if ($user): ?>
        <a href="service.php"
          class="text-xl text-slate-800 font-semibold bg-slate-50 w-fit py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-slate-50">Rent
          Now!</a>
      <?php elseif (!$user): ?>
        <a href="registration.php"
          class="text-xl text-slate-800 font-semibold bg-slate-50 w-fit py-2 px-4 rounded-lg hover:bg-slate-800 hover:text-slate-50">Register
          now for rent!</a>
      <?php endif ?>
    </div>
    <div class="hidden xl:flex w-[40%] items-center justify-center">
      <img src="src/image/web-source/traveling.svg" alt="" width="80%">
    </div>

    <div class="absolute top-[76%] left-1/2 transform -translate-x-1/2 -translate-y-1/2">
      <div class="w-[80rem] h-fit p-6 text-slate-800 bg-white border border-gray-200 rounded-lg shadow flex flex-col">
        <h5 class="mb-2 text-2xl font-bold tracking-tight">Why Choose E-Moto Rentals?</h5>
        <ul class="flex-grow flex flex-col gap-y-6 list-disc list-inside font-normal text-justify text-slate-800">
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

  </div>



  <!-- SECOND CONTENT -->
  <!-- <div class="flex gap-y-5 mt-48 flex-col xl:flex-row justify-center w-full gap-x-6 px-6 py-8 mx-auto">
    <div class="w-[70%] h-full flex flex-col">

    </div>

    <div class="w-[30%]">
      <div class="w-fit h-fit p-6 text-slate-800 bg-white border border-gray-200 rounded-lg shadow flex flex-col">
        <h5 class="mb-2 text-2xl font-bold tracking-tight">Our Services</h5>
        <ul class="flex-grow flex flex-col gap-y-6 list-disc list-inside font-normal text-justify text-slate-800">
          <li><strong>Flexible Rental Plans:</strong> Choose from hourly, daily, or weekly rental options to suit
            your schedule and needs.</li>
          <li><strong>Guided Tours:</strong> Join our guided tours to explore the city's top attractions and hidden
            gems with an experienced guide.</li>
          <li><strong>Corporate Rentals:</strong> Provide your employees with a green commuting option through our
            corporate rental programs.</li>
          <li><strong>Maintenance and Support:</strong> Benefit from 24/7 customer support and regular maintenance
            checks to ensure a hassle-free experience.</li>
        </ul>
      </div>
    </div>
  </div> -->
</div>




<?php require_once 'src/layouts/footer.php'; ?>