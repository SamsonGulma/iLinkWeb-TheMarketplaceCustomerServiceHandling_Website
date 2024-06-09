// Sample array of documents (replace with real data)
const documents = [
    { id: 1, name: 'Document 1', status: 'Pending' },
    { id: 2, name: 'Document 2', status: 'Pending' },
    { id: 3, name: 'Document 3', status: 'Pending' },
    { id: 4, name: 'Document 4', status: 'Pending' },
    { id: 5, name: 'Document 5', status: 'Pending' },
    { id: 6, name: 'Document 6', status: 'Pending' },
    { id: 7, name: 'Document 7', status: 'Pending' },
    { id: 8, name: 'Document 8', status: 'Pending' },
  ];
  

  function myFunction() {
    var x = document.getElementById("down");
    // if (x.className === "topnav") {
    //   x.className += " responsive";
    // } else {
    //   x.className = "topnav";
    // }
    const t = document.createElement('a');
    t.textContent = 'SignOut';
    x.appendChild(t);
  }

  // Function to render documents list
  function renderDocuments() {
    const documentsList = document.getElementById('documents-list');
    documentsList.innerHTML = '';
  
    documents.forEach(doc => {
      const documentElement = document.createElement('div');
      documentElement.classList.add('document');
      documentElement.innerHTML = `
        <p>${doc.name}</p>
        <button onclick="approveDocument(${doc.id})">Approve</button>
      `;
      documentsList.appendChild(documentElement);
    });
  }
  
  // Function to approve a document
  function approveDocument(id) {
    const documentIndex = documents.findIndex(doc => doc.id === id);
    if (documentIndex !== -1) {
      documents[documentIndex].status = 'Approved';
      renderDocuments(); // Re-render documents list after approval
    }
  }
  
  // Initial rendering
  renderDocuments();
  