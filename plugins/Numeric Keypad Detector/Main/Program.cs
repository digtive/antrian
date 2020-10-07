using System;
using System.Linq;
using System.Security.Cryptography;
using Newtonsoft.Json.Linq;
using System.Windows.Forms;
using Linearstar.Windows.RawInput;
using WpfRawInput;
using System.Text;

namespace RawInput.Sharp.SimpleExample
{
    class Program
    {
        static void Main()
        {
            // Get the devices that can be handled with Raw Input.
            var devices = RawInputDevice.GetDevices();
                


            // Keyboards will be returned as a RawInputKeyboard.
            var keyboards = devices.OfType<RawInputKeyboard>();

/*            // List them up.
            foreach (var device in keyboards)
                Console.WriteLine($"{device.DeviceType} {device.VendorId:X4}:{device.ProductId:X4} {device.ManufacturerName}, {device.DevicePath}");
*/
            // To begin catching inputs, first make a window that listens WM_INPUT.
            var window = new RawInputReceiverWindow();

            window.Input += (sender, e) =>
            {
                string strResponse = String.Empty;
                // Catch your input here!
                RestClient  restClient = new RestClient();
                StringCipher stringChiper = new StringCipher();

                string url = System.IO.File.ReadAllText(@"C:\xampp\htdocs\antrian\data\url.txt");
                string keyboarData = e.Data.ToString();
                string id = e.Data.Device.DevicePath.ToString();
                string hashPath = MD5Hash(id);
                string keyboardUrl = url + "/Services/keyboardCall?path=" + hashPath + "&key=" + keyboarData;

                restClient.endPoint = keyboardUrl;
                strResponse = restClient.MakeRequest();


            };

            try
            {
                // Register the HidUsageAndPage to watch any device.
                RawInputDevice.RegisterDevice(HidUsageAndPage.Keyboard, RawInputDeviceFlags.ExInputSink | RawInputDeviceFlags.NoLegacy, window.Handle);

                var registered = RawInputDevice.GetDevices();
                Console.WriteLine(registered);
                Application.Run();
            }
            finally
            {
                RawInputDevice.UnregisterDevice(HidUsageAndPage.Keyboard);
            }
        }

        private static void Window_Kambing(object sender, RawInputEventArgs e)
        {
            throw new NotImplementedException();
        }
        public static string MD5Hash(string input)
        {
            StringBuilder hash = new StringBuilder();
            MD5CryptoServiceProvider md5provider = new MD5CryptoServiceProvider();
            byte[] bytes = md5provider.ComputeHash(new UTF8Encoding().GetBytes(input));

            for (int i = 0; i < bytes.Length; i++)
            {
                hash.Append(bytes[i].ToString("x2"));
            }
            return hash.ToString();
        }

    }
}
