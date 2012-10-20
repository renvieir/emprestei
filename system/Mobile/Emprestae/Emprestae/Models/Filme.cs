﻿using System;
using System.Net;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Ink;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Shapes;
using System.Runtime.Serialization;

namespace Emprestae.Models
{
    [DataContract]
    public class Filme
    {
        [DataMember]
        public int idFilme { get; set; }

        [DataMember]
        public string titulo { get; set; }

        [DataMember]
        public string distribuidora { get; set; }

        [DataMember]
        public string diretor { get; set; }

        [DataMember]
        public string imagePath { get; set; }
    }
}
