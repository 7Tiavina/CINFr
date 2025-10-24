@extends('layouts.app')

@section('title', 'Liste des mairies - CINFr')

@section('styles')
<style>
  #banner {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: #fff;
    padding: 3rem 1rem;
  }

  #banner h1 {
    font-weight: 700;
  }

  #search-input {
    border-radius: 50px;
    padding: 1rem 1.5rem;
    border: none;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }

  .departments-table {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
    margin-top: 2rem;
  }

  @media (min-width: 768px) {
    .departments-table {
      grid-template-columns: 1fr 1fr;
    }
  }

  .department {
    background: #fff;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .department:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  .department h3 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0;
  }

  .toggle-icon {
    font-size: 1.2rem;
    transition: transform 0.3s ease;
  }

  .department.open .toggle-icon {
    transform: rotate(180deg);
  }

  .mairies-list {
    list-style: none;
    padding-left: 0;
    margin-top: 1rem;
    display: none;
  }

  .mairies-list li {
    padding: 0.6rem 0;
    border-bottom: 1px solid #eee;
  }

  .mairies-list li:last-child {
    border-bottom: none;
  }
</style>
@endsection

@section('content')
<section id="banner" class="text-center">
  <div class="container">
    <h1>Liste des mairies délivrant des cartes d'identité par département</h1>
    <div class="row justify-content-center mt-4">
      <div class="col-md-12">
        <input type="text" class="form-control" id="search-input" placeholder="🔍 Rechercher une mairie ou un département...">
      </div>
    </div>
  </div>
</section>

<section id="departments">
  <div class="container">
    <div class="departments-table" id="departments-table">
      @foreach ($mairies as $departement => $mairies_list)
      <div class="department" data-department="{{ $departement }}">
        <h3>{{ $departement }} <span class="toggle-icon">▼</span></h3>
        <ul class="mairies-list">
          @foreach ($mairies_list as $mairie)
            <li>{{ $mairie }}</li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fuse.js@6.6.2"></script>
<script>
  const mairiesData = @json($mairies);
  const searchInput = document.getElementById('search-input');
  const table = document.getElementById('departments-table');

  const mairiesList = Object.entries(mairiesData).flatMap(([department, mairies]) =>
    mairies.map(mairie => ({ department, mairie }))
  );

  const fuse = new Fuse(mairiesList, {
    threshold: 0.3,
    keys: ['mairie', 'department']
  });

  searchInput.addEventListener('input', e => {
    const query = e.target.value.trim();
    table.innerHTML = '';

    const results = query.length ? fuse.search(query).map(r => r.item) : mairiesList;

    const grouped = results.reduce((acc, { department, mairie }) => {
      if (!acc[department]) acc[department] = [];
      acc[department].push(mairie);
      return acc;
    }, {});

    Object.entries(grouped).forEach(([dep, list]) => {
      const deptDiv = document.createElement('div');
      deptDiv.className = 'department';
      deptDiv.innerHTML = `
        <h3>${dep} <span class="toggle-icon">▼</span></h3>
        <ul class="mairies-list">${list.map(m => `<li>${m}</li>`).join('')}</ul>
      `;
      table.appendChild(deptDiv);
    });

    attachDepartmentEvents();
  });

  function attachDepartmentEvents() {
    document.querySelectorAll('.department').forEach(dep => {
      dep.onclick = () => {
        dep.classList.toggle('open');
        const list = dep.querySelector('.mairies-list');
        list.style.display = list.style.display === 'block' ? 'none' : 'block';
      };
    });
  }

  attachDepartmentEvents();
</script>
@endsection