class Provider {
  persons = require('./data/persons.json');

  getById(id) {
    return this.persons.filter(p => p.id === id);
  }
  getAll() {
    return this.persons;
  }
  insert(person) {
    this.persons.push(person);
  }
  update(person) {
    const index = this.persons.findIndex(p => p.id === person.id);
    if (index) this.persons[index] = person;
  }
  remove(person) {
    this.persons.filter(p => p.id !== person.id);
  }

  getProperties() {
    return ['Id', 'Name', 'Username', 'Email', 'Address', 'Phone', 'Website', 'Company'];
  }
}

export default Provider;