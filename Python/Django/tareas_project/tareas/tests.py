from django.test import TestCase, Client
from django.urls import reverse
from .models import Etiqueta, Tarea
from django.contrib.auth.models import User

class TareaTestCase(TestCase):
    def setUp(self):
        self.user = User.objects.create_user(username='testuser', password='12345')
        self.client.login(username='testuser', password='12345')
        self.tarea = Tarea.objects.create(titulo='Test Tarea', usuario=self.user)

    def test_tarea_creation(self):
        self.assertEqual(self.tarea.titulo, 'Test Tarea')
        self.assertEqual(str(self.tarea), 'Test Tarea')

    def test_tarea_lista_view(self):
        response = self.client.get(reverse('tareas:tarea_lista'))
        self.assertEqual(response.status_code, 200)
        self.assertTemplateUsed(response, 'tareas/tarea_lista.html')

    def test_tarea_crear_view(self):
        response = self.client.post(reverse('tareas:tarea_crear'), {
            'titulo': 'Nueva Tarea',
            'descripcion': '',
            'completada': 'False'
        })
        print("Status code:", response.status_code)
        print("Response content:", response.content.decode())
        self.assertEqual(response.status_code, 302)  # Redirección tras éxito
        self.assertEqual(Tarea.objects.count(), 2)  # Verifica que se creó una tarea