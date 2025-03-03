from django import forms

# Create your forms here.
class formulario_de_contacto(forms.Form):
    asunto = forms.CharField()
    email = forms.EmailField()
    mensaje = forms.CharField()